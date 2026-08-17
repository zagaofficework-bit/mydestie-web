<?php 
$cat_id = 0;
if (isset($_GET['cat_id']) && (int)$_GET['cat_id'] > 0) {
    $cat_id = (int)$_GET['cat_id'];
} elseif (isset($_POST['cat_id']) && (int)$_POST['cat_id'] > 0) {
    $cat_id = (int)$_POST['cat_id'];
}

$page_title = ($cat_id > 0) ? 'Edit Category' : 'Add Category';

include("includes/header.php");
require_once("thumbnail_images.class.php");

// Helper function to create URL-friendly slugs
if (!function_exists('createSlug')) {
    function createSlug($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        if (function_exists('iconv')) {
            $text = @iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return empty($text) ? 'n-a' : $text;
    }
}

// Ensure target directories exist
if (!is_dir('images')) { @mkdir('images', 0777, true); }
if (!is_dir('images/thumb')) { @mkdir('images/thumb', 0777, true); }

// ==========================================
// FORM / API SUBMISSION PROCESSING
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $category_image = "";

    // Allow cat_id from POST if present
    if (isset($_POST['cat_id']) && (int)$_POST['cat_id'] > 0) {
        $cat_id = (int)$_POST['cat_id'];
    }

    $category_name = isset($_POST['category_name']) ? cleanInput($_POST['category_name']) : '';

    if (!empty($category_name)) {
        // File Upload Handler
        if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name  = $_FILES['category_image']['tmp_name'];
            $orig_name = $_FILES['category_image']['name'];
            $file_ext  = strtolower(pathinfo($orig_name, PATHINFO_EXTENSION));
            $allowed   = array('jpg', 'jpeg', 'png', 'gif', 'webp');

            if (in_array($file_ext, $allowed)) {
                $clean_filename = preg_replace("/[^a-zA-Z0-9_\.-]/", "_", pathinfo($orig_name, PATHINFO_FILENAME));
                $category_image = rand(10000, 99999) . "_" . $clean_filename . "." . $file_ext;

                $tpath1    = 'images/' . $category_image;
                $thumbpath = 'images/thumb/' . $category_image;

                // Attempt Compression or Direct Move
                $compressed = compress_image($tmp_name, $tpath1, 80);
                if (!$compressed || !file_exists($tpath1)) {
                    move_uploaded_file($tmp_name, $tpath1);
                }

                // Create Thumbnail
                if (file_exists($tpath1)) {
                    create_thumb_image($tpath1, $thumbpath, 300, 300);
                }
            }
        }

        $category_path = createSlug($category_name);

        if ($cat_id === 0) {
            // Insert Mode
            $data = array(
                'category_name'  => $category_name,
                'category_image' => $category_image,
                'path'           => $category_path,
                'status'         => 1
            );

            Insert('tbl_category', $data);
            $_SESSION['msg'] = "10"; // Category Added Successfully
        } else {
            // Update Mode
            if (!empty($category_image)) {
                // Unlink old image if new one uploaded
                $img_res = mysqli_query($mysqli, "SELECT category_image FROM tbl_category WHERE cid = '" . $cat_id . "'");
                if ($img_res && $img_row = mysqli_fetch_assoc($img_res)) {
                    if (!empty($img_row['category_image'])) {
                        @unlink('images/' . $img_row['category_image']);
                        @unlink('images/thumb/' . $img_row['category_image']);
                    }
                }

                $data = array(
                    'category_name'  => $category_name,
                    'category_image' => $category_image,
                    'path'           => $category_path
                );
            } else {
                $data = array(
                    'category_name' => $category_name,
                    'path'          => $category_path
                );
            }

            Update('tbl_category', $data, "WHERE cid = '" . $cat_id . "'");
            $_SESSION['msg'] = "11"; // Category Updated Successfully
        }

        // Check if API / JSON response is requested
        $is_json = (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) || 
                   (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

        if ($is_json) {
            header('Content-Type: application/json');
            echo json_encode([
                "status" => 1,
                "message" => ($cat_id === 0) ? "Category added successfully" : "Category updated successfully",
                "cat_id" => $cat_id
            ]);
            exit;
        }

        header("Location: manage_category.php");
        exit;
    } else {
        $_SESSION['msg'] = "1"; // Missing input
    }
}

// Fetch row for edit view
$row = array();
if ($cat_id > 0) {
    $stmt = mysqli_prepare($mysqli, "SELECT * FROM tbl_category WHERE `cid` = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $cat_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    }
}
?>

<div class="row">
  <div class="col-md-12">
    <?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
      <a href="<?= htmlspecialchars($_SERVER['HTTP_REFERER'], ENT_QUOTES, 'UTF-8'); ?>">
        <h4 class="pull-left" style="font-size: 20px; color: #e91e63"><i class="fa fa-arrow-left"></i> Back</h4>
      </a>
    <?php } ?>

    <div class="card">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title"><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="card-body mrg_bottom"> 
        <form action="<?= ($cat_id == 0) ? 'add_category.php' : 'add_category.php?cat_id=' . $cat_id; ?>" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
          
          <input type="hidden" name="cat_id" value="<?= ($cat_id > 0) ? $cat_id : ''; ?>" />

          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-md-3 control-label">Category Name :-</label>
                <div class="col-md-6">
                  <input type="text" name="category_name" id="category_name" value="<?= isset($row['category_name']) ? htmlspecialchars($row['category_name'], ENT_QUOTES, 'UTF-8') : ''; ?>" class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label">Select Image :-
                  <p class="control-label-help">(Recommended Resolution: 300x300, 400x400 or Square Image)</p>
                </label>
                <div class="col-md-6">
                  <div class="fileupload_block">
                    <input type="file" name="category_image" id="fileupload">
                    <div class="fileupload_img featured_image">
                      <?php if (!empty($row['category_image']) && file_exists('images/' . $row['category_image'])) { ?>
                        <img src="images/<?= htmlspecialchars($row['category_image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Featured image" id="ImdID" style="height: 90px; width: 90px; object-fit: cover;"/>
                      <?php } else { ?>
                        <img id="ImdID" src="assets/images/landscape.jpg" alt="Featured image" style="height: 90px; width: 90px"/>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                  <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>