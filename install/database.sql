--
-- Table structure for table `tbl_active_log`
--

CREATE TABLE `tbl_active_log` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_active_log`
--

INSERT INTO `tbl_active_log` (`id`, `user_id`, `date_time`) VALUES
(1, 2, '1667991610');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'viaviwebtech@gmail.com', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `category_image` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`, `category_image`, `path`, `status`) VALUES
(1, 'BAR', '42267_bar.png', '', 1),
(2, 'HOTELS', '24772_restaurant.png', '', 1),
(3, 'ATM', '2796_banks.png', '', 1),
(4, 'BANKS', '71030_banks.png', '', 1),
(5, 'BEACH', '45092_beach.png', '', 1),
(6, 'TEMPLE', '55166_temple.png', '', 1),
(7, 'CINEMA', '48990_cinema.png', '', 1),
(8, 'ZOO', '6549_zoo.png', '', 1),
(9, 'MALL', '29712_mall.png', '', 1),
(10, 'RESTAURANT ', '61465_24772_restaurant.png', '', 1),
(11, 'EDUCATION', '41543_education.png', '', 1),
(12, 'COFFEE', '84580_coffee.png', '', 1),
(13, 'CASINO', '34748_casino.png', '', 1),
(14, 'MEDICAL', '2170_medical.png', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favourite`
--

CREATE TABLE `tbl_favourite` (
  `id` int(10) NOT NULL,
  `place_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_favourite`
--

INSERT INTO `tbl_favourite` (`id`, `place_id`, `user_id`, `created_at`) VALUES
(1, 22, 2, '1667991651'),
(2, 13, 2, '1667991656'),
(3, 4, 2, '1667991672'),
(4, 11, 2, '1667991684'),
(5, 14, 2, '1667991687');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_places`
--

CREATE TABLE `tbl_places` (
  `p_id` int(11) NOT NULL,
  `p_cat_id` int(11) NOT NULL,
  `place_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `place_image` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `place_video` text CHARACTER SET utf8mb4 NOT NULL,
  `place_description` text CHARACTER SET utf8mb4 NOT NULL,
  `place_address` text CHARACTER SET utf8mb4 NOT NULL,
  `place_email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `place_phone` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `place_website` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `place_map_latitude` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `place_map_longitude` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `place_status` int(1) NOT NULL DEFAULT 1,
  `place_featured` int(1) NOT NULL DEFAULT 0,
  `place_rate_avg` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `place_total_rate` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_places`
--

INSERT INTO `tbl_places` (`p_id`, `p_cat_id`, `place_name`, `place_image`, `place_video`, `place_description`, `place_address`, `place_email`, `place_phone`, `place_website`, `place_map_latitude`, `place_map_longitude`, `place_status`, `place_featured`, `place_rate_avg`, `place_total_rate`, `total_views`) VALUES
(4, 3, 'The Roxy Club', '56542_TheRoxyClub.jpg', 'https://www.youtube.com/watch?v=7PtOQrXUNLI', '<p>The <strong>Roxy Club Incepted in the year 2016, in Sector-3, Rohini, New Delhi, India)</strong>, we &quot;The Roxy Club&quot; are the distinguished service provider engaged in providing Disc, Restaurant &amp; Bar, Party place, Catering Services, Restaurants Services, etc. These services are widely demanded in special occasions such as corporate parties, birthday party, company annual day celebrations etc.</p>\r\n', 'Manglam Paradise Mall, Ground Floor, Rohini Sector 3, Delhi - 110085 ', 'info@theroxyclub.in', '0123456789', 'http://www.theroxyclub.in', '28.698520', '77.114198', 1, 1, '3', '2', 82),
(9, 7, 'Inox R-City Ghatkopar', '42108_inox.jpg', 'https://www.youtube.com/watch?v=7PtOQrXUNLI', '<p>Book Movie Tickets for Inox R City Ghatkopar Mumbai at Paytm.com. Select movie show timings and Ticket Price of your choice in the movie theatre near you.</p>\r\n', '3rd Floor, FC, Lal Bahadur Shastri Marg, Amrut Nagar, Ghatkopar West, Mumbai, Maharashtra 400086', 'info@bigcinemas.com', '02267755811', 'http://www.bigcinemas.com', '19.099755', '72.915916', 1, 0, '0', '0', 22),
(10, 1, 'Casino Palms', '43087_20.jpg', 'https://www.youtube.com/watch?v=7PtOQrXUNLI', '<p>Casino Palms is the largest and most spacious onshore casino in north Goa. It is located within the La Calypso Hotel, Baga and offers electronic gaming</p>\r\n', 'No.7/129-B,Saunta Vadoo, Calangute-Baga Road, Bardez, Baga, Goa 403516', 'info@example.com', '08326516666', 'http://example.com', '15.558482', '73.755267', 1, 0, '2', '1', 41),
(11, 4, 'Central Bank Of India', '71347_central-ll.jpg', 'https://www.youtube.com/watch?v=7PtOQrXUNLI', '<p>Central Bank of India</p>\r\n', '5197/98, Sadar Bazar, Delhi - 110006', 'info@centralbankofindia.co.in', '+(91)-11-23624327', 'http://www.centralbankofindia.co.in', '28.656955', '77.212203', 1, 0, '4', '3', 99),
(13, 6, 'HDFC Bank Ltd', '94949_hdfc.jpg', 'https://www.youtube.com/watch?v=En59smQSApU', '<p>HDFC Bank Ltd</p>\r\n', 'Shop No-6, Csc, Rohini Sector 18, Delhi - 110085', 'info@hdfcbank.com', '+(91)-11-61606161', 'http://www.hdfcbank.com/', '28.738394', '77.139866', 1, 1, '3', '1', 27),
(14, 8, 'Tuscany Gardens', '60317_t1.jpg', 'https://www.youtube.com/watch?v=7PtOQrXUNLI', '<p>Traditional Italian favourites in a European-style dining room and leafy garden setting.</p>\r\n', 'Main Road, Near Kingfisher Villa, Sinquirim, Candolim, Goa 403515', 'info@example.com', '9922914663', 'http://example.com', '15.502889', '73.771128', 1, 1, '0', '0', 19),
(22, 10, 'Slink &amp; Bardot', '41596_9-slink-bardot-mumbai-indiact-jan19-pr.jpg', '', '<p>Don&rsquo;t be put off by the winding, narrow bylanes through which you have to manoeuvre your way to get here.&nbsp;</p>\r\n', 'Slink &amp; Bardot, Thadani House 329/A, opposite Indian Coast Guard Worli Village, Mumbai, Maharashtra 400030, India', 'indianaccent@gmail.com', '917045904728', 'https://www.google.co.in/', '18.969049', '72.821182', 1, 1, '5', '8', 305);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place_gallery`
--

CREATE TABLE `tbl_place_gallery` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_place_gallery`
--

INSERT INTO `tbl_place_gallery` (`id`, `place_id`, `image_name`) VALUES
(1, 4, '31851_2.jpg'),
(2, 4, '14141_the-roxy-club-rohini-sector-3-delhi-8kc5p.jpg'),
(3, 4, '63510_the-roxy-club-rohini-sector-3-delhi-eihxq.jpg'),
(11, 9, '59262_inox.jpg'),
(12, 10, '42553_20.jpg'),
(13, 13, '63125_hdfc.jpg'),
(15, 11, '72314_central-ll.jpg'),
(16, 14, '42022_Malaka-Spice-1-600x400.jpg'),
(17, 14, '27523_Peshawari-1.jpg'),
(18, 14, '33081_t1.jpg'),
(28, 22, '40194_9-slink-bardot-mumbai-indiact-jan19-pr.jpg'),
(29, 22, '54844_in.jpg'),
(30, 22, '57421_3-the-table-mumbai-indiacnt-jan19-pr.jpg'),
(31, 22, '65759_4-bomras-indiacnt-jan19-pr.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `post_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `rate` int(11) NOT NULL,
  `dt_rate` timestamp NOT NULL DEFAULT current_timestamp(),
  `message` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `post_id`, `user_id`, `ip`, `rate`, `dt_rate`, `message`) VALUES
(1, 13, 1, '132', 3, '2021-09-21 09:16:32', 'Nice.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `envato_buyer_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `envato_purchase_code` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `envato_purchased_status` int(1) NOT NULL DEFAULT 0,
  `envato_ios_purchase_code` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `envato_ios_purchased_status` int(2) NOT NULL DEFAULT 0,
  `package_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `ios_bundle_identifier` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `onesignal_app_id` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `onesignal_rest_key` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `app_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_logo` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_version` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_author` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_contact` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_website` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_description` text CHARACTER SET utf8mb4 NOT NULL,
  `app_developed_by` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_privacy_policy` text CHARACTER SET utf8mb4 NOT NULL,
  `api_cat_order_by` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `api_cat_post_order_by` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `publisher_id` varchar(255) DEFAULT NULL,
  `interstital_ad` varchar(255) DEFAULT NULL,
  `interstital_ad_id` varchar(255) DEFAULT NULL,
  `interstital_ad_click` varchar(255) DEFAULT NULL,
  `banner_ad` varchar(255) DEFAULT NULL,
  `banner_ad_id` varchar(255) DEFAULT NULL,
  `banner_unity_id` varchar(255) DEFAULT NULL,
  `interstital_facebook_id` varchar(255) DEFAULT NULL,
  `interstitial_unity_id` varchar(255) DEFAULT NULL,
  `android_ad_network` varchar(255) DEFAULT NULL,
  `banner_applovin_id` varchar(255) DEFAULT NULL,
  `interstitial_applovin_id` varchar(255) DEFAULT NULL,
  `start_ads_id` varchar(255) DEFAULT NULL,
  `banner_facebook_id` varchar(255) DEFAULT NULL,
  `nativ_ad` varchar(255) DEFAULT NULL,
  `nativ_ad_id` varchar(255) DEFAULT NULL,
  `nativ_ad_click` varchar(255) DEFAULT NULL,
  `nativ_facebook_id` varchar(255) DEFAULT NULL,
  `nativ_applovin_id` varchar(255) DEFAULT NULL,
  `unity_game_id` varchar(255) DEFAULT NULL,
  `banner_wortise_id` varchar(255) DEFAULT NULL,
  `interstitial_wortise_id` varchar(255) DEFAULT NULL,
  `native_wortise_id` varchar(255) DEFAULT NULL,
  `app_from_email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `app_update_status` varchar(10) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'false',
  `app_new_version` double NOT NULL DEFAULT 1,
  `app_update_desc` text CHARACTER SET utf8mb4 NOT NULL,
  `app_redirect_url` text CHARACTER SET utf8mb4 NOT NULL,
  `cancel_update_status` varchar(10) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'false',
  `api_page_limit` int(11) NOT NULL DEFAULT 5,
  `account_delete_intruction` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `envato_buyer_name`, `envato_purchase_code`, `envato_purchased_status`, `envato_ios_purchase_code`, `envato_ios_purchased_status`, `package_name`, `ios_bundle_identifier`, `onesignal_app_id`, `onesignal_rest_key`, `app_name`, `app_logo`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `api_cat_order_by`, `api_cat_post_order_by`, `publisher_id`, `interstital_ad`, `interstital_ad_id`, `interstital_ad_click`, `banner_ad`, `banner_ad_id`, `banner_unity_id`, `interstital_facebook_id`, `interstitial_unity_id`, `android_ad_network`, `banner_applovin_id`, `interstitial_applovin_id`, `start_ads_id`, `banner_facebook_id`, `nativ_ad`, `nativ_ad_id`, `nativ_ad_click`, `nativ_facebook_id`, `nativ_applovin_id`, `unity_game_id`, `banner_wortise_id`, `interstitial_wortise_id`, `native_wortise_id`, `app_from_email`, `app_update_status`, `app_new_version`, `app_update_desc`, `app_redirect_url`, `cancel_update_status`, `api_page_limit`, `account_delete_intruction`) VALUES
(1, '', '', 0, '', 1, 'com.example.placefinderapp', 'com.example.placefinderapp', '5a701f93-a95c-4586-a0e4-6a1a87bc2a62', 'NTQ4MGI1YzYtY2QwYy00YmY5LWI0MmQtYzU0MTk4N2UzMDRh', 'Place Finder App', '96.png', 'info@viaviweb.com', '1.0.1', 'Viavi Webtech', '+91 9227777522', 'www.viaviweb.com', '<p>Viavi Webtech is Finest offshore IT Company which has expertise in the below mentioned all technologies and our professional, dedicated approach towards our work has always satisfied our clients as well as users.&nbsp;</p>\r\n\r\n<p><strong>Skype ID:</strong> support.viaviweb<br />\r\n<strong>Email:</strong> info@viaviweb.com<br />\r\n<strong>WhatsApp:</strong> (+91) 9227777522<br />\r\n<br />\r\n<strong>PORTFOLIO:</strong> <em><strong><a href=\"https://codecanyon.net/user/viaviwebtech/portfolio?ref=viaviwebtech\">CODECANYON</a></strong></em></p>\r\n', 'Viavi Webtech', '<p><strong>We are committed to protecting your privacy</strong></p>\r\n\r\n<p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. This policy indicates the type of processes that may result in data being collected about you. Your use of this website gives us the right to collect that information.&nbsp;</p>\r\n\r\n<p><strong>Information Collected</strong></p>\r\n\r\n<p>We may collect any or all of the information that you give us depending on the type of transaction you enter into, including your name, address, telephone number, and email address, together with data about your use of the website. Other information that may be needed from time to time to process a request may also be collected as indicated on the website.</p>\r\n\r\n<p><strong>Information Use</strong></p>\r\n\r\n<p>We use the information collected primarily to process the task for which you visited the website. Data collected in the UK is held in accordance with the Data Protection Act. All reasonable precautions are taken to prevent unauthorised access to this information. This safeguard may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>Your Internet browser has the in-built facility for storing small files - &quot;cookies&quot; - that hold information which allows a website to recognise your account. Our website takes advantage of this facility to enhance your experience. You have the ability to prevent your computer from accepting cookies but, if you do, certain functionality on the website may be impaired.</p>\r\n\r\n<p><strong>Disclosing Information</strong></p>\r\n\r\n<p>We do not disclose any personal information obtained about you from this website to third parties unless you permit us to do so by ticking the relevant boxes in registration or competition forms. We may also use the information to keep in contact with you and inform you of developments associated with us. You will be given the opportunity to remove yourself from any mailing list or similar device. If at any time in the future we should wish to disclose information collected on this website to any third party, it would only be with your knowledge and consent.&nbsp;</p>\r\n\r\n<p>We may from time to time provide information of a general nature to third parties - for example, the number of individuals visiting our website or completing a registration form, but we will not use any information that could identify those individuals.&nbsp;</p>\r\n\r\n<p>In addition Dummy may work with third parties for the purpose of delivering targeted behavioural advertising to the Dummy website. Through the use of cookies, anonymous information about your use of our websites and other websites will be used to provide more relevant adverts about goods and services of interest to you. For more information on online behavioural advertising and about how to turn this feature off, please visit youronlinechoices.com/opt-out.</p>\r\n\r\n<p><strong>Changes to this Policy</strong></p>\r\n\r\n<p>Any changes to our Privacy Policy will be placed here and will supersede this version of our policy. We will take reasonable steps to draw your attention to any changes in our policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>\r\n\r\n<p><strong>Contacting Us</strong></p>\r\n\r\n<p>If you have any questions about our Privacy Policy, or if you want to know what information we have collected about you, please email us at vp.201087@gmail.com. You can also correct any factual errors in that information or require us to remove your details form any list under our control.</p>\r\n', 'category_name', 'DESC', 'pub-9456493320432553', 'true', 'ca-app-pub-3940256099942544/1033173712', '5', 'true', 'ca-app-pub-3940256099942544/6300978111', 'Banner_Android', 'IMG_16_9_APP_INSTALL#293685261999350_293692201998656', 'Interstitial_Android', 'admob', '3221a2640039c8a8', '06b9bf27824eb7f6', '208651629', 'IMG_16_9_APP_INSTALL#288347782353524_288349185686717', 'true', 'ca-app-pub-3940256099942544/2247696110', '4', 'IMG_16_9_APP_INSTALL#293685261999350_293692201998656', '0d3c3740628feba8', '4613148', '', '', '', '-', 'false', 1, 'kindly update new version of app', 'https://play.google.com/store/apps/dev?id=7157478532572017100', 'true', 10, '<p><strong>Contact&nbsp;</strong></p>\r\n\r\n<p><strong>Email :-&nbsp;&nbsp;</strong><strong>info@viaviweb.com</strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(10) NOT NULL,
  `place_id` int(10) NOT NULL DEFAULT 0,
  `slider_type` varchar(30) DEFAULT NULL,
  `external_url` text DEFAULT NULL,
  `external_image` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `place_id`, `slider_type`, `external_url`, `external_image`, `status`) VALUES
(3, 0, 'external', 'https://codecanyon.net/item/online-shopping-cms-ecommerce-system-ecommerce-marketplace-buy-sell-paypal-stripe-cod/25683842?s_rank=1', '71584_slider.png', 1),
(4, 13, 'Place', '', '34599_slider.jpg', 1),
(5, 9, 'Place', '', '59433_slider.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smtp_settings`
--

CREATE TABLE `tbl_smtp_settings` (
  `id` int(5) NOT NULL,
  `smtp_type` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `smtp_host` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `smtp_email` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `smtp_password` text CHARACTER SET utf8mb4 NOT NULL,
  `smtp_secure` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `port_no` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `smtp_ghost` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `smtp_gemail` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `smtp_gpassword` text CHARACTER SET utf8mb4 NOT NULL,
  `smtp_gsecure` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `gport_no` varchar(10) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_smtp_settings`
--

INSERT INTO `tbl_smtp_settings` (`id`, `smtp_type`, `smtp_host`, `smtp_email`, `smtp_password`, `smtp_secure`, `port_no`, `smtp_ghost`, `smtp_gemail`, `smtp_gpassword`, `smtp_gsecure`, `gport_no`) VALUES
(1, 'server', '', '', '', 'ssl', '465', 'smtp.gmail.com', '', '', 'ssl', '465');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `auth_id` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `registration_on` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0',
  `confirm_code` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_type`, `name`, `email`, `password`, `phone`, `auth_id`, `registration_on`, `confirm_code`, `status`) VALUES
(1, 'Normal', 'User', 'user.viaviweb@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1234567890', '', '1613197017', '', '1'),
(2, 'Normal', 'demoapp', 'demoapp@gmail.com', '8ce135b5a2361f7eecb83a42f2df15e2', '1234567890', NULL, '1667991600', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_places`
--
ALTER TABLE `tbl_places`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_place_gallery`
--
ALTER TABLE `tbl_place_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_places`
--
ALTER TABLE `tbl_places`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_place_gallery`
--
ALTER TABLE `tbl_place_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;