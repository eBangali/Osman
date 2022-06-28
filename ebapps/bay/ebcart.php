<?php
namespace ebapps\bay;
/*****************************************************************************
############################### GNU General Public License ###################
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
#############################################################################

We have to pay commission from profit and sales commission can not be negative. So we must have to profit.
Cost Price = CP = Promotional Cost =  Production Cost + 30 Production Cost/100 as Promotional Cost 

Profit Loss Formula: CP + P.CP = MP - D.MP
Here, 
Sales Price = SP
Marked Price = MP
Profit Percent = P
Discount Percent = D

*****************************************************************************/
include_once(ebbd.'/dbconfig.php');
use ebapps\dbconnection\dbconfig;
/*** ***/
include_once(ebbd.'/eBConDb.php');
use ebapps\dbconnection\eBConDb;
/*** ***/
include_once(ebphpmailer.'/Exception.php');
use ebapps\PHPMailer\Exception;
/*** ***/
include_once(ebphpmailer.'/PHPMailer.php');
use ebapps\PHPMailer\PHPMailer;
/*** ***/
include_once(ebphpmailer.'/SMTP.php');
use ebapps\PHPMailer\SMTP;
//
class ebcart extends dbconfig
{
/*** ***/
public function __construct()
{
parent::__construct();

include_once(ebbay.'/htaccessBayGenerator.php');

/* ######## Shipmentable Product eCommerce ######## */ 
eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_category_a` (
`bay_category_a_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_category_a` varchar(64) NOT NULL,
PRIMARY KEY (`bay_category_a_id`),
UNIQUE KEY `bay_category_a` (`bay_category_a`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_category_b` (
`bay_category_b_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_category_b` varchar(64) NOT NULL,
`bay_category_a_in_bay_category_b` varchar(64) NOT NULL,
PRIMARY KEY (`bay_category_b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_category_c` (
`bay_category_c_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_category_c` varchar(64) NOT NULL,
`bay_category_a_in_bay_category_c` varchar(64) NOT NULL,
`bay_category_b_in_bay_category_c` varchar(64) NOT NULL,
PRIMARY KEY (`bay_category_c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_category_d` (
`bay_category_d_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_category_d` varchar(64) NOT NULL,
`bay_category_a_in_bay_category_d` varchar(64) NOT NULL,
`bay_category_b_in_bay_category_d` varchar(64) NOT NULL,
`bay_category_c_in_bay_category_d` varchar(64) NOT NULL,
PRIMARY KEY (`bay_category_d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");


eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_merchant_add_items` (
`bay_merchant_add_items_id` int(11) NOT NULL AUTO_INCREMENT,
`username_merchant_adi` varchar(64) NOT NULL,
`tracking_unique_product_adi` varchar(80) NOT NULL,
`m_product_approved` int(3) NOT NULL,
`m_category_a` varchar(64) NOT NULL,
`m_category_b` varchar(64) NOT NULL,
`m_category_c` varchar(64) NOT NULL,
`m_category_d` varchar(64) NOT NULL,
`m_og_image_url` varchar(255) NOT NULL,
`m_og_small_image_url` varchar(255) NOT NULL,
`m_og_image_title` varchar(160) NOT NULL,
`m_og_image_description` longtext NOT NULL,
`m_showroom_id` varchar(64) NOT NULL,
`m_size` varchar(16) NOT NULL,
`m_costprice_price` double(16,2) NOT NULL,
`m_stock` int(11) NOT NULL,
`m_profit_percent` double(16,2) NOT NULL,
`m_discount_percent` double(16,2) NOT NULL,
`m_marked_price` double(16,2) NOT NULL,
`m_vat_tax` double(16,2) NOT NULL,
`m_weight` double(16,2) NOT NULL,
`m_handling_packing` double(16,2) NOT NULL,
`m_country_of_origin` int(4) NOT NULL,
`m_video_link` varchar(255) NOT NULL,
`m_date` varchar(64) NOT NULL,
PRIMARY KEY (`bay_merchant_add_items_id`),
KEY `username_merchant_adi` (`username_merchant_adi`),
KEY `tracking_unique_product_adi` (`tracking_unique_product_adi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_merchant_multi_img` (
`bay_multi_image_id` int(11) NOT NULL AUTO_INCREMENT,
`add_items_id_in_bay_merchant_multi_img` int(11) NOT NULL,
`bay_image_approved` int(1) NOT NULL,
`bay_big_imag_url` varchar(255) NOT NULL,
PRIMARY KEY (`bay_multi_image_id`),
KEY `add_items_id_in_bay_merchant_multi_img` (`add_items_id_in_bay_merchant_multi_img`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_showroom_approved_items` (
`bay_showroom_approved_items_id` int(11) NOT NULL AUTO_INCREMENT,
`username_merchant_ai` varchar(64) NOT NULL,
`tracking_unique_product_ai` varchar(80) NOT NULL,
`s_product_approved` int(3) NOT NULL,
`s_category_a` varchar(64) NOT NULL,
`s_category_b` varchar(64) NOT NULL,
`s_category_c` varchar(64) NOT NULL,
`s_category_d` varchar(64) NOT NULL,
`s_og_image_url` varchar(255) NOT NULL,
`s_og_small_image_url` varchar(255) NOT NULL,
`s_og_image_title` varchar(160) NOT NULL,
`s_og_image_description` longtext NOT NULL,
`s_showroom_id` varchar(64) NOT NULL,
`s_size` varchar(16) NOT NULL,
`s_costprice_price` double(16,2) NOT NULL,
`s_stock` int(11) NOT NULL,
`s_profit_percent` double(16,2) NOT NULL,
`s_discount_percent` double(16,2) NOT NULL,
`s_marked_price` double(16,2) NOT NULL,
`s_vat_tax` double(16,2) NOT NULL,
`s_weight` double(16,2) NOT NULL,
`s_handling_packing` double(16,2) NOT NULL,
`s_country_of_origin` int(4) NOT NULL,
`s_video_link` varchar(255) NOT NULL,
`s_date` varchar(64) NOT NULL,
PRIMARY KEY (`bay_showroom_approved_items_id`),
KEY `username_merchant_ai` (`username_merchant_ai`),
KEY `tracking_unique_product_ai` (`tracking_unique_product_ai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_mer_bay_appro_m2m` (
`bay_order_m2m_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_mer_id_in_m2m` int(11) NOT NULL,
`bay_appro_id_in_m2m` int(11) NOT NULL,
`tracking_bay_mer_bay_appro` varchar(80) NOT NULL,
PRIMARY KEY (`bay_order_m2m_id`),
KEY `bay_mer_id_in_m2m` (`bay_mer_id_in_m2m`),
KEY `bay_appro_id_in_m2m` (`bay_appro_id_in_m2m`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_salse_report_stock_update` (
`salse_report_unique_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer_sr` varchar(64) NOT NULL,
`tracking_unique_sales_order_sr` varchar(80) NOT NULL,
`tracking_unique_product_sr` varchar(80) NOT NULL,
`bay_showroom_approved_items_id_sr` varchar(80) NOT NULL,
`sqtn_sr` int(11) NOT NULL,
`item_total_price_sr` double(16,2) NOT NULL,
`item_total_tax_sr` double(16,2) NOT NULL,
`size_sr` varchar(255) NOT NULL,
`sdate_sr` varchar(64) NOT NULL,
`username_salse_sr` varchar(64) NOT NULL,
`username_merchant_sr` varchar(64) NOT NULL,
`payment_status` varchar(8) NOT NULL,
PRIMARY KEY (`salse_report_unique_id`),
KEY `username_buyer_sr` (`username_buyer_sr`),
KEY `tracking_unique_sales_order_sr` (`tracking_unique_sales_order_sr`),
KEY `tracking_unique_product_sr` (`tracking_unique_product_sr`),
KEY `username_salse_sr` (`username_salse_sr`),
KEY `username_merchant_sr` (`username_merchant_sr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_shipping_address_crm` (
`shipping_address_gross_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer_sa` varchar(64) NOT NULL,
`tracking_unique_sales_order_sa` varchar(80) NOT NULL,
`full_name_sa` varchar(64) NOT NULL,
`address_line_1_sa` varchar(80) NOT NULL,
`address_line_2_sa` varchar(80) NOT NULL,
`city_town_sa` varchar(64) NOT NULL,
`state_province_region_sa` varchar(64) NOT NULL,
`postal_code_sa` varchar(64) NOT NULL,
`phone_mobile_sa` varchar(64) NOT NULL,
`country_sa` varchar(64) NOT NULL,
`geolocation_latitude` varchar(32) NOT NULL,
`geolocation_longitude` varchar(32) NOT NULL,
PRIMARY KEY (`shipping_address_gross_id`),
KEY `username_buyer_sa` (`username_buyer_sa`),
KEY `tracking_unique_sales_order_sa` (`tracking_unique_sales_order_sa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");


eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_items_order_crm` (
`items_order_unique_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer_io` varchar(64) NOT NULL,
`tracking_unique_sales_order_io` varchar(80) NOT NULL,
`tracking_unique_product_io` varchar(80) NOT NULL,
`bay_showroom_approved_items_id_io` int(11) NOT NULL,
`sqtn_io` int(11) NOT NULL,
`size_io` varchar(64) NOT NULL,
`item_total_price_io` double(16,2) NOT NULL,
`item_total_handling_io` double(16,2) NOT NULL,
`item_total_tax_vat_io` double(16,2) NOT NULL,
`item_total_shipping_io` double(16,2) NOT NULL,
`sdate_io` varchar(64) NOT NULL,
`username_salseman_io` varchar(64) NOT NULL,
`username_merchant_io` varchar(64) NOT NULL,
`payment_status` varchar(8) NOT NULL,
PRIMARY KEY (`items_order_unique_id`),
KEY `username_buyer_io` (`username_buyer_io`),
KEY `tracking_unique_sales_order_io` (`tracking_unique_sales_order_io`),
KEY `tracking_unique_product_io` (`tracking_unique_product_io`),
KEY `username_salseman_io` (`username_salseman_io`),
KEY `username_merchant_io` (`username_merchant_io`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_order_m2m_for_crm` (
`bay_order_m2m_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_appro_id_in_order_m2m` int(11) NOT NULL,
`username_buyer_in_m2m_for_crm` varchar(64) NOT NULL,
`username_merchant_in_m2m_for_crm` varchar(64) NOT NULL,
`tracking_unique_sales_order_in_m2m` varchar(80) NOT NULL,
`payment_status` varchar(8) NOT NULL,
PRIMARY KEY (`bay_order_m2m_id`),
KEY `bay_appro_id_in_order_m2m` (`bay_appro_id_in_order_m2m`),
KEY `username_buyer_in_m2m_for_crm` (`username_buyer_in_m2m_for_crm`),
KEY `username_merchant_in_m2m_for_crm` (`username_merchant_in_m2m_for_crm`),
KEY `tracking_unique_sales_order_in_m2m` (`tracking_unique_sales_order_in_m2m`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_shipment_prove_crm` (
`shipment_prove_gross_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer_spg` varchar(64) NOT NULL,
`tracking_unique_sales_order_spg` varchar(80) NOT NULL,
`bay_product_id_in_prove_crm` int(11) NOT NULL,
`shipment_date_spg` varchar(64) NOT NULL,
`courier_service_name_spg` varchar(64) NOT NULL,
`tracking_number_courier_services_spg` varchar(80) NOT NULL,
`username_merchant_spg` varchar(64) NOT NULL,
`payment_status` varchar(8) NOT NULL,
`handover_delevery_status` varchar(16) NOT NULL,
`origin_product_2client` varchar(8) NOT NULL,
PRIMARY KEY (`shipment_prove_gross_id`),
KEY `username_buyer_spg` (`username_buyer_spg`),
KEY `tracking_unique_sales_order_spg` (`tracking_unique_sales_order_spg`),
KEY `bay_product_id_in_prove_crm` (`bay_product_id_in_prove_crm`),
KEY `tracking_number_courier_services_spg` (`tracking_number_courier_services_spg`),
KEY `username_merchant_spg` (`username_merchant_spg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_returns_refunds_crm` (
`bay_returns_refunds_gross_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer_rrg` varchar(64) NOT NULL,
`username_merchant_rrg` varchar(64) NOT NULL,
`tracking_unique_sales_order_rrg` varchar(80) NOT NULL,
`bay_product_id_in_returns_refunds_crm` int(11) NOT NULL,
`returns_refunds_comment_rrg` varchar(255) NOT NULL,
`return_size_crm` varchar(16) NOT NULL,
`total_qtn_crm` int(11) NOT NULL,
`return_qtn_crm` int(11) NOT NULL,
`total_refund_with_shipment_without_texvat` double(16,2) NOT NULL,
`return_refund_total_crm` double(16,2) NOT NULL,
`purchase_date` varchar(64) NOT NULL,
`now_date` varchar(64) NOT NULL,
`request_date` varchar(64) NOT NULL,
`received_return_item` varchar(16) NOT NULL,
`request_status` varchar(16) NOT NULL,
`payment_status` varchar(8) NOT NULL,
`payment_method` varchar(8) NOT NULL,
`payment_currency` varchar(8) NOT NULL,
PRIMARY KEY (`bay_returns_refunds_gross_id`),
KEY `username_buyer_rrg` (`username_buyer_rrg`),
KEY `username_merchant_rrg` (`username_merchant_rrg`),
KEY `tracking_unique_sales_order_rrg` (`tracking_unique_sales_order_rrg`),
KEY `bay_product_id_in_returns_refunds_crm` (`bay_product_id_in_returns_refunds_crm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_refunds_history` (
`refunds_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer` varchar(64) NOT NULL,
`username_merchant` varchar(64) NOT NULL,
`tracking_unique_sales_order_id` varchar(80) NOT NULL,
`bay_product_id` int(11) NOT NULL,
`returns_extra_comment` varchar(255) NOT NULL,
`refund_paid_amount` double(16,2) NOT NULL,
`used_payment_method_bkash_paypal_strip` varchar(8) NOT NULL,
`payment_from_bkash_paypal_strip_id` varchar(64) NOT NULL,
`payment_to_bkash_paypal_strip_id` varchar(64) NOT NULL,
`payment_tranjaction_id` varchar(64) NOT NULL,
`paid_date` varchar(64) NOT NULL,
`currency` varchar(8) NOT NULL,
PRIMARY KEY (`refunds_id`),
KEY `username_buyer` (`username_buyer`),
KEY `username_merchant` (`username_merchant`),
KEY `tracking_unique_sales_order_id` (`tracking_unique_sales_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_buyer_support_multiple_items` (
`bay_support_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_order_tracking_id` varchar(80) NOT NULL,
`bay_product_id_in_buyer_support` int(11) NOT NULL,
`bay_username_buyer_seller` varchar(64) NOT NULL,
`bay_username_seller` varchar(64) NOT NULL,
`bay_support_requirements` varchar(1024) NOT NULL,
`bay_support_buyer_post_date` varchar(64) NOT NULL,
`bay_buyer_payment_status` varchar(8) NOT NULL,
PRIMARY KEY (`bay_support_id`),
KEY `bay_username_buyer_seller` (`bay_username_buyer_seller`),
KEY `bay_username_seller` (`bay_username_seller`),
KEY `bay_buyer_payment_status` (`bay_buyer_payment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_rating_multiple_items` (
`bay_rating_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_product_id_in_rating` int(11) NOT NULL,
`bay_tracking_order_id_in_rating` varchar(80) NOT NULL,
`bay_username_buyer_in_rating` varchar(64) NOT NULL,
`bay_rating_for_quality_satisfaction` int(4) NOT NULL,
`bay_rating_for_communication_satisfaction` int(4) NOT NULL,
`bay_rating_testimonial` varchar(255) NOT NULL,
`bay_rating_status` varchar(8) NOT NULL,
`bay_rating_date` varchar(64) NOT NULL,
PRIMARY KEY (`bay_rating_id`),
KEY `bay_product_id_in_rating` (`bay_product_id_in_rating`),
KEY `bay_tracking_order_id_in_rating` (`bay_tracking_order_id_in_rating`),
KEY `bay_username_buyer_in_rating` (`bay_username_buyer_in_rating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
	
eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_like` (
`bay_like_id` int(11) NOT NULL AUTO_INCREMENT,
`bay_id_in_bay_like` int(11) NOT NULL,
`bay_username` varchar(64) NOT NULL,
`bay_like_date` varchar(64) NOT NULL,
PRIMARY KEY (`bay_like_id`),
KEY `bay_username` (`bay_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");


eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_payment_gross_crm` (
`payment_gross_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer_pg` varchar(64) NOT NULL,
`tracking_unique_sales_order_pg` varchar(80) NOT NULL,
`txn_id_pg` varchar(160) NOT NULL,
`mc_gross_pg` double(16,2) NOT NULL,
`mc_currency_pg` varchar(64) NOT NULL,
`payment_status_pg` varchar(64) NOT NULL,
`first_name_pg` varchar(64) NOT NULL,
`last_name_pg` varchar(64) NOT NULL,
`payer_email_pg` varchar(64) NOT NULL,
`payment_date_pg` varchar(64) NOT NULL,
`payment_fee_pg` double(16,2) NOT NULL,
PRIMARY KEY (`payment_gross_id`),
KEY `username_buyer_pg` (`username_buyer_pg`),
KEY `tracking_unique_sales_order_pg` (`tracking_unique_sales_order_pg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_bkash_gross_crm` (
`payment_bk_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer_bk` varchar(64) NOT NULL,
`bay_id_in_bk` int(11) NOT NULL,
`order_tracking_unique_bk` varchar(80) NOT NULL,
`bay_name_in_bk` varchar(160) NOT NULL,
`bay_qtn_in_bk` int(11) NOT NULL,
`vat_of_bay_bk` double(16,2) NOT NULL,
`bay_sub_total_price_bk` double(16,2) NOT NULL,
`shipment_fee_of_item_bk` double(16,2) NOT NULL,
`grand_total_price_bk` double(16,2) NOT NULL,
`bkash_tranjaction_id_bk` varchar(160) NOT NULL,
`bkash_payment_status` varchar(8) NOT NULL,
`payment_date_bk` varchar(64) NOT NULL,  
PRIMARY KEY (`payment_bk_id`),
KEY `username_buyer_bk` (`username_buyer_bk`),
KEY `order_tracking_unique_bk` (`order_tracking_unique_bk`),
KEY `bkash_tranjaction_id_bk` (`bkash_tranjaction_id_bk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_branding_carosoul` (
`branding_id` int(11) NOT NULL AUTO_INCREMENT,
`username_merchant` varchar(64) NOT NULL,
`branding_active` int(3) NOT NULL,
`branding_title` varchar(160) NOT NULL,
`branding_url` varchar(255) NOT NULL,
`branding_image_url` varchar(255) NOT NULL,
`branding_start_date` varchar(64) NOT NULL,
PRIMARY KEY (`branding_id`),
KEY `username_merchant` (`username_merchant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_product_sales_commissions` (
`sales_comm_id` int(11) NOT NULL AUTO_INCREMENT,
`username_buyer_sales_comm` varchar(64) NOT NULL,
`username_saler_sales_comm` varchar(64) NOT NULL,
`username_referrer` varchar(64) NOT NULL,
`tracking_unique_sales_comm` varchar(80) NOT NULL,
`bay_product_id` int(11) NOT NULL,
`bay_product_qtn_sales_comm` int(11) NOT NULL,
`total_price_per_item` double(16,2) NOT NULL,
`total_commi_self` double(16,2) NOT NULL,
`total_commi_level_first` double(16,2) NOT NULL,
`bkash_tranjaction_sales_comm` varchar(64) NOT NULL,
`payment_status` varchar(16) NOT NULL,
`sales_date` varchar(64) NOT NULL,
`self_payment_status` varchar(16) NOT NULL,
`ref_payment_status` varchar(16) NOT NULL,
`payment_through_paypal_bkash` varchar(64) NOT NULL,
`paid_through_paypal_bkash` varchar(64) NOT NULL,
`ref_paid_through_paypal_bkash` varchar(64) NOT NULL,
`self_payment_date` varchar(64) NOT NULL, 
`ref_payment_date` varchar(64) NOT NULL, 
`self_tranjaction_id` varchar(64) NOT NULL,
`ref_tranjaction_id` varchar(64) NOT NULL,    
PRIMARY KEY (`sales_comm_id`),
KEY `username_buyer_sales_comm` (`username_buyer_sales_comm`),
KEY `username_saler_sales_comm` (`username_saler_sales_comm`),
KEY `tracking_unique_sales_comm` (`tracking_unique_sales_comm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_size_all` (`size_id`, `size_name`) VALUES
(1, 'NA'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, '5'),
(8, '6'),
(9, '7'),
(10, '8'),
(11, '9'),
(12, '10'),
(13, '11'),
(14, '12'),
(15, '13')");


eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_a` (`bay_category_a_id`, `bay_category_a`) VALUES
(4, 'Electronics'),
(1, 'Fashion'),
(5, 'First-Food'),
(6, 'Grocery'),
(2, 'Home-and-Garden'),
(3, 'Sporting-Goods'),
(7, 'Stationery-and-Gift')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_b` (`bay_category_b_id`, `bay_category_b`, `bay_category_a_in_bay_category_b`) VALUES
(1, 'Men-s', 'Fashion'),
(2, 'Women-s', 'Fashion'),
(3, 'Kids-and-Baby', 'Fashion'),
(4, 'Jewelry-and-Watches', 'Fashion'),
(5, 'Handbags-and-Accessories', 'Fashion'),
(6, 'Health-and-Beauty', 'Fashion'),
(7, 'Home-Decorators', 'Home-and-Garden'),
(8, 'Home-Improvement', 'Home-and-Garden'),
(9, 'Bath', 'Home-and-Garden'),
(10, 'Bedding', 'Home-and-Garden'),
(11, 'Crafts', 'Home-and-Garden'),
(12, 'Furniture', 'Home-and-Garden'),
(13, 'Household-Cleaning-and-Supplies', 'Home-and-Garden'),
(14, 'Kitchen-Dining-and-Bar-Supplies', 'Home-and-Garden'),
(15, 'Lamps-Lighting-and-Ceiling-Fans', 'Home-and-Garden'),
(16, 'Major-Appliances-Parts-and-Accessories', 'Home-and-Garden'),
(17, 'Rugs-and-Carpets', 'Home-and-Garden'),
(18, 'Tools', 'Home-and-Garden'),
(19, 'Window-Treatments-and-Hardware', 'Home-and-Garden'),
(20, 'Yard-Garden-and-Outdoor-Living-Items', 'Home-and-Garden'),
(21, 'Cycling', 'Sporting-Goods'),
(22, 'Fishing', 'Sporting-Goods'),
(23, 'Fitness-Running-and-Yoga', 'Sporting-Goods'),
(24, 'Golf-Goods', 'Sporting-Goods'),
(25, 'Hunting', 'Sporting-Goods'),
(26, 'Indoor-Game-Goods', 'Sporting-Goods'),
(27, 'Outdoor-Sports-Goods', 'Sporting-Goods'),
(28, 'Team-Sports', 'Sporting-Goods'),
(29, 'Tennis-and-Racquet-Goods', 'Sporting-Goods'),
(30, 'Water-Sports-Goods', 'Sporting-Goods'),
(31, 'Winter-Sport-Goods', 'Sporting-Goods'),
(32, 'Boxing-Martial-Arts-and-MMA', 'Sporting-Goods'),
(33, 'Cellphones-and-Accessories', 'Electronics'),
(34, 'Cameras-and-Photo', 'Electronics'),
(35, 'Computers-and-Tablets', 'Electronics'),
(36, 'Vehicle-Electronics-and-GPS', 'Electronics'),
(37, 'TV-Audio-and-Surveillance', 'Electronics'),
(38, 'Video-Games-and-Consoles', 'Electronics'),
(39, 'Consumer-Electronics', 'Electronics'),
(40, 'Bengali', 'First-Food'),
(41, 'Indian', 'First-Food'),
(42, 'Chinese', 'First-Food'),
(43, 'Italian', 'First-Food'),
(44, 'Food-and-Beverage', 'Grocery'),
(45, 'Frozen-Items', 'Grocery'),
(46, 'Organic', 'Grocery'),
(47, 'Health-and-Beauty', 'Grocery'),
(48, 'Household-and-Cleaning', 'Grocery'),
(49, 'Pet-Care', 'Grocery')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_c` (`bay_category_c_id`, `bay_category_c`, `bay_category_a_in_bay_category_c`, `bay_category_b_in_bay_category_c`) VALUES
(1, 'T-Shirts', 'Fashion', 'Men-s'),
(2, 'Casual-Shirts', 'Fashion', 'Men-s'),
(3, 'Sweats-and-Hoodies', 'Fashion', 'Men-s'),
(4, 'Sweaters', 'Fashion', 'Men-s'),
(5, 'Jeans', 'Fashion', 'Men-s'),
(6, 'Pants', 'Fashion', 'Men-s'),
(7, 'Coats-and-Jackets', 'Fashion', 'Men-s'),
(8, 'Suits', 'Fashion', 'Men-s'),
(9, 'Athletic-Apparel', 'Fashion', 'Men-s'),
(10, 'Socks', 'Fashion', 'Men-s'),
(11, 'Underwear', 'Fashion', 'Men-s'),
(12, 'Accessories', 'Fashion', 'Men-s'),
(13, 'Shoes', 'Fashion', 'Men-s'),
(14, 'Dresses', 'Fashion', 'Women-s'),
(15, 'Tops-and-Blouses', 'Fashion', 'Women-s'),
(16, 'T-Shirts', 'Fashion', 'Women-s'),
(17, 'Sweaters', 'Fashion', 'Women-s'),
(18, 'Coats-and-Jackets', 'Fashion', 'Women-s'),
(19, 'Jeans', 'Fashion', 'Women-s'),
(20, 'Pants', 'Fashion', 'Women-s'),
(21, 'Shorts', 'Fashion', 'Women-s'),
(22, 'Skirts', 'Fashion', 'Women-s'),
(23, 'Swimwear', 'Fashion', 'Women-s'),
(24, 'Suits-and-Blazers', 'Fashion', 'Women-s'),
(25, 'Intimates-and-Sleepwear', 'Fashion', 'Women-s'),
(26, 'Girls-Newborn-5T', 'Fashion', 'Kids-and-Baby'),
(27, 'Girls-4-and-Up', 'Fashion', 'Kids-and-Baby'),
(28, 'Boys-Newborn-5T', 'Fashion', 'Kids-and-Baby'),
(29, 'Boys-4-and-Up', 'Fashion', 'Kids-and-Baby'),
(30, 'Watches', 'Fashion', 'Jewelry-and-Watches'),
(31, 'Fine-Jewelry', 'Fashion', 'Jewelry-and-Watches'),
(32, 'Fashion-Jewelry', 'Fashion', 'Jewelry-and-Watches'),
(33, 'Engagement-and-Wedding-Jewelry', 'Fashion', 'Jewelry-and-Watches'),
(34, 'Men-s-Jewelry', 'Fashion', 'Jewelry-and-Watches'),
(35, 'Vintage-and-Antique-Jewelry', 'Fashion', 'Jewelry-and-Watches'),
(36, 'Loose-Diamonds-and-Gemstones', 'Fashion', 'Jewelry-and-Watches'),
(37, 'Loose-Beads', 'Fashion', 'Jewelry-and-Watches'),
(38, 'Children-s-Jewelry', 'Fashion', 'Jewelry-and-Watches'),
(39, 'Ethnic-Regional-and-Tribal-Jewelry', 'Fashion', 'Jewelry-and-Watches'),
(40, 'Handcrafted-Jewelry', 'Fashion', 'Jewelry-and-Watches'),
(41, 'Jewelry-Boxes-and-Organizers', 'Fashion', 'Jewelry-and-Watches'),
(42, 'Jewelry-Design-and-Repair', 'Fashion', 'Jewelry-and-Watches'),
(43, 'Women-s-Handbags', 'Fashion', 'Handbags-and-Accessories'),
(44, 'Women-s-Accessories', 'Fashion', 'Handbags-and-Accessories'),
(45, 'Men-s-Accessories', 'Fashion', 'Handbags-and-Accessories'),
(46, 'Makeup', 'Fashion', 'Health-and-Beauty'),
(47, 'Fragrances', 'Fashion', 'Health-and-Beauty'),
(48, 'Skin-Care', 'Fashion', 'Health-and-Beauty'),
(49, 'Bath-and-Body', 'Fashion', 'Health-and-Beauty'),
(50, 'Manicure-and-Pedicure', 'Fashion', 'Health-and-Beauty'),
(51, 'Hair-Care-and-Styling', 'Fashion', 'Health-and-Beauty'),
(52, 'Vitamins-and-Dietary-Supplements', 'Fashion', 'Health-and-Beauty'),
(53, 'Health-Care', 'Fashion', 'Health-and-Beauty'),
(54, 'Oral-Care', 'Fashion', 'Health-and-Beauty'),
(55, 'Medical-Mobility-and-Disability', 'Fashion', 'Health-and-Beauty'),
(56, 'Shaving-and-Hair-Removal', 'Fashion', 'Health-and-Beauty'),
(57, 'Tattoos-and-Body-Art', 'Fashion', 'Health-and-Beauty'),
(58, 'Massages', 'Fashion', 'Health-and-Beauty'),
(59, 'Natural-and-Alternative-Remedies', 'Fashion', 'Health-and-Beauty'),
(60, 'Cell-Phones-and-Smartphones', 'Electronics', 'Cellphones-and-Accessories'),
(61, 'Batteries', 'Electronics', 'Cellphones-and-Accessories'),
(62, 'Cases-Covers-and-Skins', 'Electronics', 'Cellphones-and-Accessories'),
(63, 'Chargers-Cradles', 'Electronics', 'Cellphones-and-Accessories'),
(64, 'Headsets', 'Electronics', 'Cellphones-and-Accessories'),
(65, 'Digital-Cameras', 'Electronics', 'Cameras-and-Photo'),
(66, 'Lenses-Filters', 'Electronics', 'Cameras-and-Photo'),
(67, 'Camcorders', 'Electronics', 'Cameras-and-Photo'),
(68, 'Binoculars-Telescopes', 'Electronics', 'Cameras-and-Photo'),
(69, 'Flashes-and-Flash-Accessories', 'Electronics', 'Cameras-and-Photo'),
(70, 'Camera-and-Photo-Accessories', 'Electronics', 'Cameras-and-Photo'),
(71, 'Tripods-and-Supports', 'Electronics', 'Cameras-and-Photo'),
(72, 'Lighting-and-Studio', 'Electronics', 'Cameras-and-Photo'),
(73, 'Film-Photography', 'Electronics', 'Cameras-and-Photo'),
(74, 'Video-Production-Editing', 'Electronics', 'Cameras-and-Photo'),
(75, 'GPS-Units', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(76, 'GPS-Accessories-and-Tracking', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(77, '12-Volt-Portable-Appliances', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(78, 'Car-Alarms-and-Security', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(79, 'Car-Audio', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(80, 'Car-Video', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(81, 'Car-Electronics-Accessories', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(82, 'Marine-Audio', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(83, 'Radar-and-Laser-Detectors', 'Electronics', 'Vehicle-Electronics-and-GPS'),
(84, 'DVD-and-Blu-ray-Players', 'Electronics', 'TV-Audio-and-Surveillance'),
(85, 'Headphones', 'Electronics', 'TV-Audio-and-Surveillance'),
(86, 'Home-Audio', 'Electronics', 'TV-Audio-and-Surveillance'),
(87, 'Home-Speakers-and-Subwoofers', 'Electronics', 'TV-Audio-and-Surveillance'),
(88, 'Home-Surveillance', 'Electronics', 'TV-Audio-and-Surveillance'),
(89, 'Portable-Audio-and-Accessories', 'Electronics', 'TV-Audio-and-Surveillance'),
(90, 'Televisions', 'Electronics', 'TV-Audio-and-Surveillance'),
(91, 'Home-Theater-Systems', 'Electronics', 'TV-Audio-and-Surveillance'),
(92, 'Vintage', 'Electronics', 'TV-Audio-and-Surveillance'),
(93, 'Xbox-One', 'Electronics', 'Video-Games-and-Consoles'),
(94, 'Xbox-360', 'Electronics', 'Video-Games-and-Consoles'),
(95, 'PlayStation-4', 'Electronics', 'Video-Games-and-Consoles'),
(96, 'PlayStation-3', 'Electronics', 'Video-Games-and-Consoles'),
(97, 'PlayStation-Handheld', 'Electronics', 'Video-Games-and-Consoles'),
(98, 'Nintendo-Wii-U', 'Electronics', 'Video-Games-and-Consoles'),
(99, 'PC-Video-Games', 'Electronics', 'Video-Games-and-Consoles'),
(100, 'PC-Gaming-Accessories', 'Electronics', 'Video-Games-and-Consoles')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_c` (`bay_category_c_id`, `bay_category_c`, `bay_category_a_in_bay_category_c`, `bay_category_b_in_bay_category_c`) VALUES
(101, 'Consoles', 'Electronics', 'Video-Games-and-Consoles'),
(102, 'Video-Games', 'Electronics', 'Video-Games-and-Consoles'),
(103, 'Video-Game-Accessories', 'Electronics', 'Video-Games-and-Consoles'),
(104, 'All-Consumer-Electronics', 'Electronics', 'Consumer-Electronics'),
(105, 'Portable-Audio-and-Headphones', 'Electronics', 'Consumer-Electronics'),
(106, 'TV-Video-and-Home-Audio', 'Electronics', 'Consumer-Electronics'),
(107, 'Vehicle-Electronics-and-GPS', 'Electronics', 'Consumer-Electronics'),
(108, 'Home-Automation', 'Electronics', 'Consumer-Electronics'),
(109, 'Home-Surveillance', 'Electronics', 'Consumer-Electronics'),
(110, 'Home-Telephones-and-Accessories', 'Electronics', 'Consumer-Electronics'),
(111, 'Multipurpose-Batteries-and-Power', 'Electronics', 'Consumer-Electronics'),
(112, 'Radio-Communication', 'Electronics', 'Consumer-Electronics'),
(113, 'Gadgets-and-Other-Electronics', 'Electronics', 'Consumer-Electronics'),
(114, 'Vintage-Electronics', 'Electronics', 'Consumer-Electronics'),
(115, 'Audio-Docks-and-Speakers', 'Electronics', 'Cellphones-and-Accessories'),
(116, 'Screen-Protectors', 'Electronics', 'Cellphones-and-Accessories'),
(117, 'Cable-and-Adapters', 'Electronics', 'Cellphones-and-Accessories'),
(118, 'Car-Speakerphones', 'Electronics', 'Cellphones-and-Accessories'),
(119, 'Mounts-and-Holders', 'Electronics', 'Cellphones-and-Accessories'),
(120, 'Styluses', 'Electronics', 'Cellphones-and-Accessories'),
(121, 'Cellphone-Accessories', 'Electronics', 'Cellphones-and-Accessories'),
(122, 'iPad-Tablet-eBook-Accessories', 'Electronics', 'Computers-and-Tablets'),
(123, 'Laptops-and-Netbooks', 'Electronics', 'Computers-and-Tablets'),
(124, 'Desktops-and-All-In-Ones', 'Electronics', 'Computers-and-Tablets'),
(125, 'Laptop-and-Desktop-Accessories', 'Electronics', 'Computers-and-Tablets'),
(126, 'Cables-and-Connectors', 'Electronics', 'Computers-and-Tablets'),
(127, 'Computer-Components-and-Parts', 'Electronics', 'Computers-and-Tablets'),
(128, 'Drives-Storage-and-Blank-Media', 'Electronics', 'Computers-and-Tablets'),
(129, 'Enterprise-Networking-Servers', 'Electronics', 'Computers-and-Tablets'),
(130, 'Home-Networking-and-Connectivity', 'Electronics', 'Computers-and-Tablets'),
(131, 'Keyboards-Mice-and-Pointing', 'Electronics', 'Computers-and-Tablets'),
(132, 'Monitors-Projectors-and-Accs', 'Electronics', 'Computers-and-Tablets'),
(133, 'Power-Protection-Distribution', 'Electronics', 'Computers-and-Tablets'),
(134, 'Printers-Scanners-and-Supplies', 'Electronics', 'Computers-and-Tablets'),
(135, 'Accessory-Sets', 'Home-and-Garden', 'Bath'),
(136, 'Bathmats-Rugs-and-Toilet-Covers', 'Home-and-Garden', 'Bath'),
(137, 'Shower-Curtains', 'Home-and-Garden', 'Bath'),
(138, 'Soap-Dishes-and-Dispensers', 'Home-and-Garden', 'Bath'),
(139, 'Toothbrush-Holders', 'Home-and-Garden', 'Bath'),
(140, 'Towels-and-Washcloths', 'Home-and-Garden', 'Bath'),
(141, 'Pillows', 'Home-and-Garden', 'Bedding'),
(142, 'Skirts', 'Home-and-Garden', 'Bedding'),
(143, 'Blankets-and-Throws', 'Home-and-Garden', 'Bedding'),
(144, 'Comforters-and-Sets', 'Home-and-Garden', 'Bedding'),
(145, 'Duvet-Covers-and-Sets', 'Home-and-Garden', 'Bedding'),
(146, 'Mattress-Pads-and-Feather-Beds', 'Home-and-Garden', 'Bedding'),
(147, 'Pillow-Shams', 'Home-and-Garden', 'Bedding'),
(148, 'Quilts-Bedspreads-and-Coverlets', 'Home-and-Garden', 'Bedding'),
(149, 'Sheets-and-Pillowcases', 'Home-and-Garden', 'Bedding'),
(150, 'Scrapbooking-and-Paper-Crafts', 'Home-and-Garden', 'Crafts'),
(151, 'Sewing-and-Fabric', 'Home-and-Garden', 'Crafts'),
(152, 'Needlecrafts-and-Yarn', 'Home-and-Garden', 'Crafts'),
(153, 'Home-Arts-and-Crafts', 'Home-and-Garden', 'Crafts'),
(154, 'Beads-and-Jewelry-Making', 'Home-and-Garden', 'Crafts'),
(155, 'Armoires-and-Wardrobes', 'Home-and-Garden', 'Furniture'),
(156, 'Beds-and-Mattresses', 'Home-and-Garden', 'Furniture'),
(157, 'Bedroom-Sets', 'Home-and-Garden', 'Furniture'),
(158, 'Bookcases', 'Home-and-Garden', 'Furniture'),
(159, 'Cabinets-and-Cupboards', 'Home-and-Garden', 'Furniture'),
(160, 'Chairs', 'Home-and-Garden', 'Furniture'),
(161, 'Slipcovers', 'Home-and-Garden', 'Furniture'),
(162, 'Sofas-Loveseats-and-Chaises', 'Home-and-Garden', 'Furniture'),
(163, 'Tables', 'Home-and-Garden', 'Furniture'),
(164, 'Candles', 'Home-and-Garden', 'Home-Decorators'),
(165, 'Candle-Holders-and-Accessories', 'Home-and-Garden', 'Home-Decorators'),
(166, 'Clocks', 'Home-and-Garden', 'Home-Decorators'),
(167, 'Decals-Stickers-and-Vinyl-Art', 'Home-and-Garden', 'Home-Decorators'),
(168, 'Decorative-Pillows', 'Home-and-Garden', 'Home-Decorators'),
(169, 'Home-Fragrances', 'Home-and-Garden', 'Home-Decorators'),
(170, 'Lighting', 'Home-and-Garden', 'Home-Decorators'),
(171, 'Photo-Frames', 'Home-and-Garden', 'Home-Decorators'),
(172, 'Plaques-and-Signs', 'Home-and-Garden', 'Home-Decorators'),
(173, 'Posters-and-Prints', 'Home-and-Garden', 'Home-Decorators'),
(174, 'Rugs', 'Home-and-Garden', 'Home-Decorators'),
(175, 'Tapestries', 'Home-and-Garden', 'Home-Decorators'),
(176, 'Building-and-Hardware', 'Home-and-Garden', 'Home-Improvement'),
(177, 'Electrical-and-Solar', 'Home-and-Garden', 'Home-Improvement'),
(178, 'Heating-Cooling-and-Air', 'Home-and-Garden', 'Home-Improvement'),
(179, 'Home-Security', 'Home-and-Garden', 'Home-Improvement'),
(180, 'Plumbing-and-Fixtures', 'Home-and-Garden', 'Home-Improvement'),
(181, 'Bicycles', 'Sporting-Goods', 'Cycling'),
(182, 'Electric-Bicycles', 'Sporting-Goods', 'Cycling'),
(183, 'Bicycle-Frames', 'Sporting-Goods', 'Cycling'),
(184, 'Bicycle-Accessories', 'Sporting-Goods', 'Cycling'),
(185, 'Bicycle-Components-and-Parts', 'Sporting-Goods', 'Cycling'),
(186, 'Bicycle-Electronics', 'Sporting-Goods', 'Cycling'),
(187, 'Bicycle-Maintenance-and-Tools', 'Sporting-Goods', 'Cycling'),
(188, 'Books-and-Video', 'Sporting-Goods', 'Cycling'),
(189, 'Car-and-Truck-Racks', 'Sporting-Goods', 'Cycling'),
(190, 'Cycling-Clothing', 'Sporting-Goods', 'Cycling'),
(191, 'Cycling-Shoes-and-Shoe-Covers', 'Sporting-Goods', 'Cycling'),
(192, 'Helmets-and-Protective-Gear', 'Sporting-Goods', 'Cycling'),
(193, 'Sunglasses-and-Goggles', 'Sporting-Goods', 'Cycling'),
(194, 'Vintage-Cycling', 'Sporting-Goods', 'Cycling'),
(195, 'Rods', 'Sporting-Goods', 'Fishing'),
(196, 'Reels', 'Sporting-Goods', 'Fishing'),
(197, 'Rod-and-Reel-Combos', 'Sporting-Goods', 'Fishing'),
(198, 'Baits-Lures-and-Flies', 'Sporting-Goods', 'Fishing'),
(199, 'Line-and-Leaders', 'Sporting-Goods', 'Fishing'),
(200, 'Terminal-Tackle', 'Sporting-Goods', 'Fishing')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_c` (`bay_category_c_id`, `bay_category_c`, `bay_category_a_in_bay_category_c`, `bay_category_b_in_bay_category_c`) VALUES
(201, 'Clothing-Shoes-and-Accessories', 'Sporting-Goods', 'Fishing'),
(202, 'Fishing-Equipment', 'Sporting-Goods', 'Fishing'),
(203, 'Fishing-Trips', 'Sporting-Goods', 'Fishing'),
(204, 'Cardio-Equipment', 'Sporting-Goods', 'Fishing'),
(205, 'Clothing-and-Accessories', 'Sporting-Goods', 'Fitness-Running-and-Yoga'),
(206, 'Fitness-Equipment-and-Gear', 'Sporting-Goods', 'Fitness-Running-and-Yoga'),
(207, 'Fitness-Technology', 'Sporting-Goods', 'Fitness-Running-and-Yoga'),
(208, 'Gym-Bags', 'Sporting-Goods', 'Fitness-Running-and-Yoga'),
(209, 'Shoes', 'Sporting-Goods', 'Fitness-Running-and-Yoga'),
(210, 'Strength-Training', 'Sporting-Goods', 'Fitness-Running-and-Yoga'),
(211, 'Yoga-and-Pilates', 'Sporting-Goods', 'Fitness-Running-and-Yoga'),
(212, 'Bags', 'Sporting-Goods', 'Golf-Goods'),
(213, 'Balls', 'Sporting-Goods', 'Golf-Goods'),
(214, 'Clothing', 'Sporting-Goods', 'Golf-Goods'),
(215, 'Clubmaking-Products', 'Sporting-Goods', 'Golf-Goods'),
(216, 'Clubs', 'Sporting-Goods', 'Golf-Goods'),
(217, 'Golf-Shoes', 'Sporting-Goods', 'Golf-Goods'),
(218, 'Novelties-and-Gifts', 'Sporting-Goods', 'Golf-Goods'),
(219, 'Push-Pull-Golf-Carts', 'Sporting-Goods', 'Golf-Goods'),
(220, 'Tees', 'Sporting-Goods', 'Golf-Goods'),
(221, 'Training-Aids', 'Sporting-Goods', 'Golf-Goods'),
(222, 'Accessories', 'Sporting-Goods', 'Golf-Goods'),
(223, 'Vintage', 'Sporting-Goods', 'Golf-Goods'),
(224, 'Clothing-Shoes-and-Accessories', 'Sporting-Goods', 'Hunting'),
(225, 'Game-Calls', 'Sporting-Goods', 'Hunting'),
(226, 'Game-and-Trail-Cameras', 'Sporting-Goods', 'Hunting'),
(227, 'Gun-Smithing-and-Maintenance', 'Sporting-Goods', 'Hunting'),
(228, 'Gun-Storage', 'Sporting-Goods', 'Hunting'),
(229, 'Holsters-Belts-and-Pouches', 'Sporting-Goods', 'Hunting'),
(230, 'Hunting-Accessories', 'Sporting-Goods', 'Hunting'),
(231, 'Knives-and-Tools', 'Sporting-Goods', 'Hunting'),
(232, 'Reloading-Equipment', 'Sporting-Goods', 'Hunting'),
(233, 'Range-and-Shooting-Accessories', 'Sporting-Goods', 'Hunting'),
(234, 'Scopes-Optics-and-Lasers', 'Sporting-Goods', 'Hunting'),
(235, 'Tactical-and-Duty-Gear', 'Sporting-Goods', 'Hunting'),
(236, 'Taxidermy', 'Sporting-Goods', 'Hunting'),
(237, 'Vintage-Hunting', 'Sporting-Goods', 'Hunting'),
(238, 'Air-Hockey', 'Sporting-Goods', 'Indoor-Game-Goods'),
(239, 'Billiards', 'Sporting-Goods', 'Indoor-Game-Goods'),
(240, 'Darts', 'Sporting-Goods', 'Indoor-Game-Goods'),
(241, 'Foosball', 'Sporting-Goods', 'Indoor-Game-Goods'),
(242, 'Indoor-Roller-Skating', 'Sporting-Goods', 'Indoor-Game-Goods'),
(243, 'Shuffleboard', 'Sporting-Goods', 'Indoor-Game-Goods'),
(244, 'Table-Tennis-Ping-Pong', 'Sporting-Goods', 'Indoor-Game-Goods'),
(245, 'Air-Guns-and-Slingshots', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(246, 'Archery', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(247, 'Backyard-Games', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(248, 'Camping-and-Hiking', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(249, 'Climbing-and-Caving', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(250, 'Disc-Golf', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(251, 'Equestrian', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(252, 'Geocaching', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(253, 'Go-Karts-Recreational', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(254, 'Inline-and-Roller-Skating', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(255, 'Scooters', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(256, 'Skateboarding-and-Longboarding', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(257, 'Track-and-Field', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(258, 'Triathalon', 'Sporting-Goods', 'Outdoor-Sports-Goods'),
(259, 'Home-Decor', 'Home-and-Garden', 'Home-Decorators'),
(260, 'Cell-Phone-Smartphone-Parts', 'Electronics', 'Cellphones-and-Accessories'),
(261, 'Kabab', 'First-Food', 'Bengali'),
(262, 'Mutton', 'First-Food', 'Bengali'),
(263, 'Chicken', 'First-Food', 'Bengali'),
(264, 'Parata', 'First-Food', 'Bengali'),
(265, 'Biryanis', 'First-Food', 'Bengali'),
(266, 'Juice', 'First-Food', 'Bengali'),
(267, 'Drinks', 'First-Food', 'Bengali'),
(268, 'Bread', 'First-Food', 'Bengali'),
(269, 'Rost', 'First-Food', 'Bengali'),
(270, 'Kabab', 'First-Food', 'Indian'),
(271, 'Mutton', 'First-Food', 'Indian'),
(272, 'Chicken', 'First-Food', 'Indian'),
(273, 'Parata', 'First-Food', 'Indian'),
(274, 'Biryanis', 'First-Food', 'Indian'),
(275, 'Juice', 'First-Food', 'Indian'),
(276, 'Drinks', 'First-Food', 'Indian'),
(277, 'Bread', 'First-Food', 'Indian'),
(278, 'Rost', 'First-Food', 'Indian'),
(279, 'Dosa', 'First-Food', 'Indian'),
(280, 'Prawn', 'First-Food', 'Bengali'),
(281, 'Beef', 'First-Food', 'Bengali'),
(282, 'Puri', 'First-Food', 'Bengali'),
(283, 'Samucha', 'First-Food', 'Bengali'),
(284, 'Shashlik', 'First-Food', 'Bengali'),
(285, 'Potato', 'First-Food', 'Bengali'),
(286, 'Chutney', 'First-Food', 'Bengali'),
(287, 'Shawarma', 'First-Food', 'Bengali'),
(288, 'Vegetable', 'First-Food', 'Bengali'),
(289, 'Salad', 'First-Food', 'Bengali'),
(290, 'Nachos', 'First-Food', 'Bengali'),
(291, 'Fish', 'First-Food', 'Italian'),
(292, 'Noodles', 'First-Food', 'Bengali'),
(293, 'Coffee', 'First-Food', 'Bengali'),
(294, 'Soup', 'First-Food', 'Bengali'),
(295, 'Burger', 'First-Food', 'Bengali'),
(296, 'Biryani', 'First-Food', 'Bengali'),
(297, 'Biryani', 'First-Food', 'Indian'),
(298, 'Rice', 'First-Food', 'Bengali'),
(299, 'Fish', 'First-Food', 'Bengali'),
(300, 'Naan', 'First-Food', 'Bengali')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_c` (`bay_category_c_id`, `bay_category_c`, `bay_category_a_in_bay_category_c`, `bay_category_b_in_bay_category_c`) VALUES
(301, 'Parotta', 'First-Food', 'Bengali'),
(302, 'Luchi', 'First-Food', 'Bengali'),
(303, 'Sandwich', 'First-Food', 'Bengali'),
(304, 'Chana', 'First-Food', 'Bengali'),
(305, 'Onthon', 'First-Food', 'Bengali'),
(306, 'Pizza', 'First-Food', 'Bengali'),
(307, 'Green-salad', 'First-Food', 'Bengali'),
(308, 'Egg', 'Grocery', 'Food-and-Beverage'),
(309, 'Meat', 'Grocery', 'Food-and-Beverage'),
(310, 'Fish', 'Grocery', 'Food-and-Beverage'),
(311, 'Fruits', 'Grocery', 'Food-and-Beverage'),
(312, 'Dry-Fish', 'Grocery', 'Food-and-Beverage'),
(313, 'Dairy-Milk', 'Grocery', 'Food-and-Beverage'),
(314, 'Rice', 'Grocery', 'Food-and-Beverage'),
(315, 'Puls', 'Grocery', 'Food-and-Beverage'),
(316, 'Oil-and-Ghee', 'Grocery', 'Food-and-Beverage'),
(317, 'Sugar', 'Grocery', 'Food-and-Beverage'),
(318, 'Salt', 'Grocery', 'Food-and-Beverage'),
(319, 'Vegetable', 'Grocery', 'Food-and-Beverage'),
(320, 'Hot-Spices', 'Grocery', 'Food-and-Beverage'),
(321, 'Tea-and-Coffee', 'Grocery', 'Food-and-Beverage'),
(322, 'Bakery-and-Snacks', 'Grocery', 'Food-and-Beverage'),
(323, 'Beverage', 'Grocery', 'Food-and-Beverage'),
(324, 'Pet-Food', 'Grocery', 'Pet-Care'),
(325, 'Pet-Care', 'Grocery', 'Pet-Care'),
(326, 'Baby-Care', 'Grocery', 'Health-and-Beauty'),
(327, 'Beauty-and-Hygiene', 'Grocery', 'Health-and-Beauty'),
(328, 'Air-Fresheners', 'Grocery', 'Household-and-Cleaning'),
(329, 'Cleaning-Supplies', 'Grocery', 'Household-and-Cleaning'),
(330, 'Detergents-and-Dishwasher', 'Grocery', 'Household-and-Cleaning'),
(331, 'Food-Storage', 'Grocery', 'Household-and-Cleaning'),
(332, 'Kitchen-Accessories', 'Grocery', 'Household-and-Cleaning'),
(333, 'Tissue-and-Napkin', 'Grocery', 'Household-and-Cleaning'),
(334, 'Pest-Control', 'Grocery', 'Household-and-Cleaning')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(1, 'Short-Sleeve', 'Fashion', 'Men-s', 'T-Shirts'),
(2, 'Sleeveless', 'Fashion', 'Men-s', 'T-Shirts'),
(3, 'Long-Sleeve', 'Fashion', 'Men-s', 'T-Shirts'),
(4, 'Basic-Tee', 'Fashion', 'Men-s', 'T-Shirts'),
(5, 'Embellished-Tee', 'Fashion', 'Men-s', 'T-Shirts'),
(6, 'Graphic-Tee', 'Fashion', 'Men-s', 'T-Shirts'),
(7, 'Personalized-Tee', 'Fashion', 'Men-s', 'T-Shirts'),
(8, 'Button-Front', 'Fashion', 'Men-s', 'Casual-Shirts'),
(9, 'Hawaiian', 'Fashion', 'Men-s', 'Casual-Shirts'),
(10, 'Henley', 'Fashion', 'Men-s', 'Casual-Shirts'),
(11, 'Polo-Rugby', 'Fashion', 'Men-s', 'Casual-Shirts'),
(12, 'Western', 'Fashion', 'Men-s', 'Casual-Shirts'),
(13, 'Short-Sleeve', 'Fashion', 'Men-s', 'Casual-Shirts'),
(14, 'Long-Sleeve', 'Fashion', 'Men-s', 'Casual-Shirts'),
(15, 'Hoodie', 'Fashion', 'Men-s', 'Sweats-and-Hoodies'),
(16, 'Sweatshirt-Crew', 'Fashion', 'Men-s', 'Sweats-and-Hoodies'),
(17, 'Track-and-Sweat-Pants', 'Fashion', 'Men-s', 'Sweats-and-Hoodies'),
(18, 'Track-and-Sweat-Suits', 'Fashion', 'Men-s', 'Sweats-and-Hoodies'),
(19, 'Track-Jackets', 'Fashion', 'Men-s', 'Sweats-and-Hoodies'),
(20, '1/2-Zip', 'Fashion', 'Men-s', 'Sweaters'),
(21, 'Cardigan', 'Fashion', 'Men-s', 'Sweaters'),
(22, 'Crewneck', 'Fashion', 'Men-s', 'Sweaters'),
(23, 'Full-Zip', 'Fashion', 'Men-s', 'Sweaters'),
(24, 'Polo', 'Fashion', 'Men-s', 'Sweaters'),
(25, 'Turtleneck', 'Fashion', 'Men-s', 'Sweaters'),
(26, 'Vest', 'Fashion', 'Men-s', 'Sweaters'),
(27, 'V-Neck', 'Fashion', 'Men-s', 'Sweaters'),
(28, 'Baggy-Loose', 'Fashion', 'Men-s', 'Jeans'),
(29, 'Boot-Cut', 'Fashion', 'Men-s', 'Jeans'),
(30, 'Cargo', 'Fashion', 'Men-s', 'Jeans'),
(31, 'Carpenter', 'Fashion', 'Men-s', 'Jeans'),
(32, 'Classic-Straight-Leg', 'Fashion', 'Men-s', 'Jeans'),
(33, 'Relaxed', 'Fashion', 'Men-s', 'Jeans'),
(34, 'Slim-Skinny', 'Fashion', 'Men-s', 'Jeans'),
(35, 'Cargo', 'Fashion', 'Men-s', 'Pants'),
(36, 'Carpenter', 'Fashion', 'Men-s', 'Pants'),
(37, 'Casual-Pants', 'Fashion', 'Men-s', 'Pants'),
(38, 'Corduroys', 'Fashion', 'Men-s', 'Pants'),
(39, 'Dress-Flat-Front', 'Fashion', 'Men-s', 'Pants'),
(40, 'Dress-Pleat', 'Fashion', 'Men-s', 'Pants'),
(41, 'Khakis-Chinos', 'Fashion', 'Men-s', 'Pants'),
(42, 'Basic-Coat', 'Fashion', 'Men-s', 'Coats-and-Jackets'),
(43, 'Basic-Jacket', 'Fashion', 'Men-s', 'Coats-and-Jackets'),
(44, 'Fleece-Jacket', 'Fashion', 'Men-s', 'Coats-and-Jackets'),
(45, 'Flight-Bomber', 'Fashion', 'Men-s', 'Coats-and-Jackets'),
(46, 'Motorcycle', 'Fashion', 'Men-s', 'Coats-and-Jackets'),
(47, 'Parka', 'Fashion', 'Men-s', 'Coats-and-Jackets'),
(48, 'Puffer', 'Fashion', 'Men-s', 'Coats-and-Jackets'),
(49, 'Trench-Coats', 'Fashion', 'Men-s', 'Coats-and-Jackets'),
(50, 'One-Button-Suits', 'Fashion', 'Men-s', 'Suits'),
(51, 'Two-Button-Suits', 'Fashion', 'Men-s', 'Suits'),
(52, 'Three-Button-Suits', 'Fashion', 'Men-s', 'Suits'),
(53, 'Four-Button-Suits', 'Fashion', 'Men-s', 'Suits'),
(54, 'Double-Breasted-Suits', 'Fashion', 'Men-s', 'Suits'),
(55, 'Tuxedo-Suits', 'Fashion', 'Men-s', 'Suits'),
(56, 'Base-Layers', 'Fashion', 'Men-s', 'Athletic-Apparel'),
(57, 'Coats-and-Jackets', 'Fashion', 'Men-s', 'Athletic-Apparel'),
(58, 'Jerseys', 'Fashion', 'Men-s', 'Athletic-Apparel'),
(59, 'Pants', 'Fashion', 'Men-s', 'Athletic-Apparel'),
(60, 'Shirts-and-Tops', 'Fashion', 'Men-s', 'Athletic-Apparel'),
(61, 'Shorts', 'Fashion', 'Men-s', 'Athletic-Apparel'),
(62, 'Tracksuits-and-Sweats', 'Fashion', 'Men-s', 'Athletic-Apparel'),
(63, 'Athletic-Socks', 'Fashion', 'Men-s', 'Socks'),
(64, 'Casual-Socks', 'Fashion', 'Men-s', 'Socks'),
(65, 'Dress-Socks', 'Fashion', 'Men-s', 'Socks'),
(66, 'Boxer-Briefs', 'Fashion', 'Men-s', 'Underwear'),
(67, 'Boxer', 'Fashion', 'Men-s', 'Underwear'),
(68, 'Brief', 'Fashion', 'Men-s', 'Underwear'),
(69, 'Thermal', 'Fashion', 'Men-s', 'Underwear'),
(70, 'Thong-Bikini', 'Fashion', 'Men-s', 'Underwear'),
(71, 'Undershirt', 'Fashion', 'Men-s', 'Underwear'),
(72, 'Sunglasses-and-Fashion-Eyewear', 'Fashion', 'Men-s', 'Accessories'),
(73, 'Backpacks-Bags-and-Briefcases', 'Fashion', 'Men-s', 'Accessories'),
(74, 'Belts', 'Fashion', 'Men-s', 'Accessories'),
(75, 'Hats', 'Fashion', 'Men-s', 'Accessories'),
(76, 'Ties', 'Fashion', 'Men-s', 'Accessories'),
(77, 'Wallets', 'Fashion', 'Men-s', 'Accessories'),
(78, 'Money-Clips', 'Fashion', 'Men-s', 'Accessories'),
(79, 'Gloves-and-Mittens', 'Fashion', 'Men-s', 'Accessories'),
(80, 'Athletic-Shoes', 'Fashion', 'Men-s', 'Shoes'),
(81, 'Boots', 'Fashion', 'Men-s', 'Shoes'),
(82, 'Casual-Shoes', 'Fashion', 'Men-s', 'Shoes'),
(83, 'Dress-and-Formal-Shoes', 'Fashion', 'Men-s', 'Shoes'),
(84, 'Occupational-Shoes', 'Fashion', 'Men-s', 'Shoes'),
(85, 'Sandals-and-Flip-Flops', 'Fashion', 'Men-s', 'Shoes'),
(86, 'Slippers', 'Fashion', 'Men-s', 'Shoes'),
(87, 'Casual', 'Fashion', 'Women-s', 'Dresses'),
(88, 'Clubwear', 'Fashion', 'Women-s', 'Dresses'),
(89, 'Cocktail', 'Fashion', 'Women-s', 'Dresses'),
(90, 'Formal', 'Fashion', 'Women-s', 'Dresses'),
(91, 'Little-Black-Dresses', 'Fashion', 'Women-s', 'Dresses'),
(92, 'Summer-Beach', 'Fashion', 'Women-s', 'Dresses'),
(93, 'Work-Dresses', 'Fashion', 'Women-s', 'Dresses'),
(94, 'Blouses', 'Fashion', 'Women-s', 'Tops-and-Blouses'),
(95, 'Button-Down-Shirts', 'Fashion', 'Women-s', 'Tops-and-Blouses'),
(96, 'Halter', 'Fashion', 'Women-s', 'Tops-and-Blouses'),
(97, 'Knit-Tops', 'Fashion', 'Women-s', 'Tops-and-Blouses'),
(98, 'Polo-Shirt', 'Fashion', 'Women-s', 'Tops-and-Blouses'),
(99, 'Tank-Cami', 'Fashion', 'Women-s', 'Tops-and-Blouses'),
(100, 'Tunic', 'Fashion', 'Women-s', 'Tops-and-Blouses')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(101, 'Wrap', 'Fashion', 'Women-s', 'Tops-and-Blouses'),
(102, 'Blue', 'Fashion', 'Women-s', 'T-Shirts'),
(103, 'Black', 'Fashion', 'Women-s', 'T-Shirts'),
(104, 'Gray', 'Fashion', 'Women-s', 'T-Shirts'),
(105, 'White', 'Fashion', 'Women-s', 'T-Shirts'),
(106, 'Green', 'Fashion', 'Women-s', 'T-Shirts'),
(107, 'Red', 'Fashion', 'Women-s', 'T-Shirts'),
(108, 'Pink', 'Fashion', 'Women-s', 'T-Shirts'),
(109, 'Multi-Color', 'Fashion', 'Women-s', 'T-Shirts'),
(110, 'Boat-Neck', 'Fashion', 'Women-s', 'Sweaters'),
(111, 'Cardigans', 'Fashion', 'Women-s', 'Sweaters'),
(112, 'Crewneck', 'Fashion', 'Women-s', 'Sweaters'),
(113, 'Scoop-Neck', 'Fashion', 'Women-s', 'Sweaters'),
(114, 'Sweatercoats', 'Fashion', 'Women-s', 'Sweaters'),
(115, 'Tunic', 'Fashion', 'Women-s', 'Sweaters'),
(116, 'Turtleneck-Mock', 'Fashion', 'Women-s', 'Sweaters'),
(117, 'V-Neck', 'Fashion', 'Women-s', 'Sweaters'),
(118, 'Basic-Coat', 'Fashion', 'Women-s', 'Coats-and-Jackets'),
(119, 'Basic-Jackets', 'Fashion', 'Women-s', 'Coats-and-Jackets'),
(120, 'Motorcycle-Jackets', 'Fashion', 'Women-s', 'Coats-and-Jackets'),
(121, 'Parka', 'Fashion', 'Women-s', 'Coats-and-Jackets'),
(122, 'Peacoat', 'Fashion', 'Women-s', 'Coats-and-Jackets'),
(123, 'Puffer', 'Fashion', 'Women-s', 'Coats-and-Jackets'),
(124, 'Raincoats', 'Fashion', 'Women-s', 'Coats-and-Jackets'),
(125, 'Trench', 'Fashion', 'Women-s', 'Coats-and-Jackets'),
(126, 'Boot-Cut', 'Fashion', 'Women-s', 'Jeans'),
(127, 'Boyfriend', 'Fashion', 'Women-s', 'Jeans'),
(128, 'Capri-Cropped', 'Fashion', 'Women-s', 'Jeans'),
(129, 'Flare', 'Fashion', 'Women-s', 'Pants'),
(130, 'Leggings', 'Fashion', 'Women-s', 'Jeans'),
(131, 'Relaxed', 'Fashion', 'Women-s', 'Jeans'),
(132, 'Slim-Skinny', 'Fashion', 'Women-s', 'Jeans'),
(133, 'Straight-Leg', 'Fashion', 'Women-s', 'Jeans'),
(134, 'Capris-Cropped', 'Fashion', 'Women-s', 'Pants'),
(135, 'Cargo', 'Fashion', 'Women-s', 'Pants'),
(136, 'Casual-Pants', 'Fashion', 'Women-s', 'Pants'),
(137, 'Corduroys', 'Fashion', 'Women-s', 'Pants'),
(138, 'Dress-Pants', 'Fashion', 'Women-s', 'Pants'),
(139, 'Khakis-Chinos', 'Fashion', 'Women-s', 'Pants'),
(140, 'Linen', 'Fashion', 'Women-s', 'Pants'),
(141, 'Pant-Sets', 'Fashion', 'Women-s', 'Pants'),
(142, 'Athletic', 'Fashion', 'Women-s', 'Shorts'),
(143, 'Bermuda-Walking', 'Fashion', 'Women-s', 'Shorts'),
(144, 'Cargo', 'Fashion', 'Women-s', 'Shorts'),
(145, 'Casual-Shorts', 'Fashion', 'Women-s', 'Shorts'),
(146, 'Dress-Shorts', 'Fashion', 'Women-s', 'Shorts'),
(147, 'Khaki-Chino', 'Fashion', 'Women-s', 'Shorts'),
(148, 'Mini-Short-Shorts', 'Fashion', 'Women-s', 'Shorts'),
(149, 'A-Line', 'Fashion', 'Women-s', 'Skirts'),
(150, 'Full-Skirt', 'Fashion', 'Women-s', 'Skirts'),
(151, 'Maxi', 'Fashion', 'Women-s', 'Skirts'),
(152, 'Mini', 'Fashion', 'Women-s', 'Skirts'),
(153, 'Peasant-Boho', 'Fashion', 'Women-s', 'Skirts'),
(154, 'Pleated', 'Fashion', 'Women-s', 'Skirts'),
(155, 'Straight-Pencil', 'Fashion', 'Women-s', 'Skirts'),
(156, 'Stretch-Knit', 'Fashion', 'Women-s', 'Skirts'),
(157, 'Bikini', 'Fashion', 'Women-s', 'Swimwear'),
(158, 'Bikini-Bottom', 'Fashion', 'Women-s', 'Swimwear'),
(159, 'Bikini-Top', 'Fashion', 'Women-s', 'Swimwear'),
(160, 'Cover-Up', 'Fashion', 'Women-s', 'Swimwear'),
(161, 'One-Piece', 'Fashion', 'Women-s', 'Swimwear'),
(162, 'Swimdress', 'Fashion', 'Women-s', 'Swimwear'),
(163, 'Tankini', 'Fashion', 'Women-s', 'Swimwear'),
(164, 'Tankini-Top', 'Fashion', 'Women-s', 'Swimwear'),
(165, 'Blazer', 'Fashion', 'Women-s', 'Suits-and-Blazers'),
(166, 'Dress-Suits', 'Fashion', 'Women-s', 'Suits-and-Blazers'),
(167, 'Pant-Suit', 'Fashion', 'Women-s', 'Suits-and-Blazers'),
(168, 'Skirt-Suit', 'Fashion', 'Women-s', 'Suits-and-Blazers'),
(169, 'Bras-and-Bra-Sets', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(170, 'Camisoles-and-Camisole-Sets', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(171, 'Corsets-and-Bustiers', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(172, 'Garter-Belts', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(173, 'Panties', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(174, 'Shapewear', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(175, 'Sleepwear-and-Robes', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(176, 'Slips', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(177, 'Teddies', 'Fashion', 'Women-s', 'Intimates-and-Sleepwear'),
(178, 'Dresses', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(179, 'Tops-and-T-Shirts', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(180, 'Bottoms', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(181, 'Outerwear', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(182, 'Sleepwear', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(183, 'Pajamas', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(184, 'One-Pieces', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(185, 'Outfits-and-Sets', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(186, 'Sweaters', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(187, 'Swimwear', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(188, 'Shoes', 'Fashion', 'Kids-and-Baby', 'Girls-Newborn-5T'),
(189, 'Dresses', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(190, 'Tops-Shirts-and-T-Shirts', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(191, 'Jeans', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(192, 'Outerwear', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(193, 'Sleepwear', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(194, 'Pajamas', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(195, 'Sweaters', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(196, 'Sweatshirts-and-Hoodies', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(197, 'Swimwear', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(198, 'Belts-and-Belt-Buckles', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(199, 'Backpacks', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(200, 'Gloves-and-Mittens', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(201, 'Hair-Accessories', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(202, 'Hats', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(203, 'Jewelry', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(204, 'Key-Chains', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(205, 'Purses-and-Wallets', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(206, 'Scarves-and-Wraps', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(207, 'Shoe-Charms', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(208, 'Sunglasses', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(209, 'Umbrellas', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(210, 'Wristbands', 'Fashion', 'Kids-and-Baby', 'Girls-4-and-Up'),
(211, 'Tops-and-T-Shirts', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(212, 'Bottoms', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(213, 'Outerwear', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(214, 'Sleepwear', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(215, 'Pajamas', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(216, 'One-Pieces', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(217, 'Outfits-and-Sets', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(218, 'Sweaters', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(219, 'Swimwear', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(220, 'Suits', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(221, 'Shoes', 'Fashion', 'Kids-and-Baby', 'Boys-Newborn-5T'),
(222, 'Jeans', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(223, 'Outerwear', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(224, 'Sleepwear', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(225, 'Pajamas', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(226, 'Pants', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(227, 'Suits', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(228, 'Sweaters', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(229, 'Sweatshirts-and-Hoodies', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(230, 'Swimwear', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(231, 'Shoes', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(232, 'Shorts', 'Fashion', 'Kids-and-Baby', 'Boys-4-and-Up'),
(233, 'Wristwatches', 'Fashion', 'Jewelry-and-Watches', 'Watches'),
(234, 'Pocket-Watches', 'Fashion', 'Jewelry-and-Watches', 'Watches'),
(235, 'Fine-Rings', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(236, 'Necklaces-and-Pendants', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(237, 'Fine-Earrings', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(238, 'Fine-Bracelets', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(239, 'Fine-Jewelry-Sets', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(240, 'Fine-Pins-and-Brooches', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(241, 'Fine-Anklets', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(242, 'Fine-Charms-and-Charm-Bracelets', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(243, 'Bracelets', 'Fashion', 'Jewelry-and-Watches', 'Fine-Jewelry'),
(244, 'Rings', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(245, 'Anklets', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(246, 'Body-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(247, 'Body-Chains', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(248, 'Necklaces-and-Pendants', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(249, 'Fine-Earrings', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(250, 'Charms-and-Charm-Bracelets', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(251, 'Hair-and-Head-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(252, 'Toe-Rings', 'Fashion', 'Jewelry-and-Watches', 'Fashion-Jewelry'),
(253, 'Engagement-Rings', 'Fashion', 'Jewelry-and-Watches', 'Engagement-and-Wedding-Jewelry'),
(254, 'Engagement-and-Wedding-Ring-Sets', 'Fashion', 'Jewelry-and-Watches', 'Engagement-and-Wedding-Jewelry'),
(255, 'Wedding-and-Anniversary-Bands', 'Fashion', 'Jewelry-and-Watches', 'Engagement-and-Wedding-Jewelry'),
(256, 'Wedding-Party-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Engagement-and-Wedding-Jewelry'),
(257, 'Rings', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(258, 'Chains-Necklaces-and-Pendants', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(259, 'Bracelets', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(260, 'Cufflinks', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(261, 'Money-Clips', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(262, 'Bolo-Ties', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(263, 'Earrings-Studs', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(264, 'Lapel-Pins', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(265, 'Tie-Clasps-and-Tacks', 'Fashion', 'Jewelry-and-Watches', 'Men-s-Jewelry'),
(266, 'Fine-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Vintage-and-Antique-Jewelry'),
(267, 'Costume-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Vintage-and-Antique-Jewelry'),
(268, 'Vintage-Ethnic-Regional-and-Tribal-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Vintage-and-Antique-Jewelry'),
(269, 'Reproduction-Vintage-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Vintage-and-Antique-Jewelry'),
(270, 'Vintage-Handcrafted-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Vintage-and-Antique-Jewelry'),
(271, 'Loose-Cubic-Zirconia', 'Fashion', 'Jewelry-and-Watches', 'Loose-Diamonds-and-Gemstones'),
(272, 'Loose-Diamonds', 'Fashion', 'Jewelry-and-Watches', 'Loose-Diamonds-and-Gemstones'),
(273, 'Natural-Diamonds', 'Fashion', 'Jewelry-and-Watches', 'Loose-Diamonds-and-Gemstones'),
(274, 'Enhanced-Natural-Diamonds', 'Fashion', 'Jewelry-and-Watches', 'Loose-Diamonds-and-Gemstones'),
(275, 'Lab-Created-Diamonds', 'Fashion', 'Jewelry-and-Watches', 'Loose-Diamonds-and-Gemstones'),
(276, 'Rough-Natural-Diamonds', 'Fashion', 'Jewelry-and-Watches', 'Loose-Diamonds-and-Gemstones'),
(277, 'Stone', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(278, 'Lampwork', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(279, 'Metals', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(280, 'Crystal', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(281, 'Rhinestones', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(282, 'Vintage', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(283, 'Fused-Glass', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(284, 'Millefiori', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(285, 'Shell-Bone-Coral', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(286, 'Wood', 'Fashion', 'Jewelry-and-Watches', 'Loose-Beads'),
(287, 'Bracelets', 'Fashion', 'Jewelry-and-Watches', 'Children-s-Jewelry'),
(288, 'Earrings', 'Fashion', 'Jewelry-and-Watches', 'Children-s-Jewelry'),
(289, 'Necklaces-and-Pendants', 'Fashion', 'Jewelry-and-Watches', 'Children-s-Jewelry'),
(290, 'Rings', 'Fashion', 'Jewelry-and-Watches', 'Children-s-Jewelry'),
(291, 'Sets', 'Fashion', 'Jewelry-and-Watches', 'Children-s-Jewelry'),
(292, 'African', 'Fashion', 'Jewelry-and-Watches', 'Ethnic-Regional-and-Tribal-Jewelry'),
(293, 'Asian-and-East-Indian', 'Fashion', 'Jewelry-and-Watches', 'Ethnic-Regional-and-Tribal-Jewelry'),
(294, 'Celtic', 'Fashion', 'Jewelry-and-Watches', 'Ethnic-Regional-and-Tribal-Jewelry'),
(295, 'Mexican', 'Fashion', 'Jewelry-and-Watches', 'Ethnic-Regional-and-Tribal-Jewelry'),
(296, 'Middle-Eastern', 'Fashion', 'Jewelry-and-Watches', 'Ethnic-Regional-and-Tribal-Jewelry'),
(297, 'Native-American', 'Fashion', 'Jewelry-and-Watches', 'Ethnic-Regional-and-Tribal-Jewelry'),
(298, 'South-American', 'Fashion', 'Jewelry-and-Watches', 'Ethnic-Regional-and-Tribal-Jewelry'),
(299, 'Southwestern', 'Fashion', 'Jewelry-and-Watches', 'Ethnic-Regional-and-Tribal-Jewelry'),
(300, 'Altered-Art', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(301, 'Anklets', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry'),
(302, 'Bracelets', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry'),
(303, 'Brooches-Pins', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry'),
(304, 'Earrings', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry'),
(305, 'Hair-Jewelry', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry'),
(306, 'Necklaces-and-Pendants', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry'),
(307, 'Rings', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry'),
(308, 'Sets', 'Fashion', 'Jewelry-and-Watches', 'Handcrafted-Jewelry'),
(309, 'Jewelry-Boxes', 'Fashion', 'Jewelry-and-Watches', 'Jewelry-Boxes-and-Organizers'),
(310, 'Jewelry-Holders-and-Organizers', 'Fashion', 'Jewelry-and-Watches', 'Jewelry-Boxes-and-Organizers'),
(311, 'Jewelry-Cleaners-and-Polish', 'Fashion', 'Jewelry-and-Watches', 'Jewelry-Design-and-Repair'),
(312, 'Jewelry-Findings', 'Fashion', 'Jewelry-and-Watches', 'Jewelry-Design-and-Repair'),
(313, 'Jewelry-Settings', 'Fashion', 'Jewelry-and-Watches', 'Jewelry-Design-and-Repair'),
(314, 'Jewelry-Tools', 'Fashion', 'Jewelry-and-Watches', 'Jewelry-Design-and-Repair'),
(315, 'Jewelry-Workbenches', 'Fashion', 'Jewelry-and-Watches', 'Jewelry-Design-and-Repair'),
(316, 'Shoulder-Bag', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Handbags'),
(317, 'Totes-and-Shoppers', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Handbags'),
(318, 'Messenger-and-Cross-Body', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Handbags'),
(319, 'Satchel', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Handbags'),
(320, 'Hobo', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Handbags'),
(321, 'Baguette', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Handbags'),
(322, 'Backpack-Style', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Handbags'),
(323, 'Cosmetic-Bags', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Handbags'),
(324, 'Sunglasses', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Accessories'),
(325, 'Wallets', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Accessories'),
(326, 'Scarves-and-Wraps', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Accessories'),
(327, 'Belts', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Accessories'),
(328, 'Hats', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Accessories'),
(329, 'Hair-Accessories', 'Fashion', 'Handbags-and-Accessories', 'Women-s-Accessories'),
(330, 'Backpacks-Bags-and-Briefcases', 'Fashion', 'Handbags-and-Accessories', 'Men-s-Accessories'),
(331, 'Belts', 'Fashion', 'Handbags-and-Accessories', 'Men-s-Accessories'),
(332, 'Hats', 'Fashion', 'Handbags-and-Accessories', 'Men-s-Accessories'),
(333, 'Ties', 'Fashion', 'Handbags-and-Accessories', 'Men-s-Accessories'),
(334, 'Money-Clips', 'Fashion', 'Handbags-and-Accessories', 'Men-s-Accessories'),
(335, 'Apple', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(336, 'Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(337, 'LG', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(338, 'HTC', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(339, 'Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(340, 'Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(341, 'BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(342, 'Sony', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(343, 'Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(344, 'ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(345, 'Bluetooth-Wireless', 'Electronics', 'Cellphones-and-Accessories', 'Headsets'),
(346, 'Built-in-microphone', 'Electronics', 'Cellphones-and-Accessories', 'Headsets'),
(347, 'Foldable', 'Electronics', 'Cellphones-and-Accessories', 'Headsets'),
(348, 'Rechargeable', 'Electronics', 'Cellphones-and-Accessories', 'Headsets'),
(349, 'Canal-Earbud', 'Electronics', 'Cellphones-and-Accessories', 'Headsets'),
(350, 'Earbud', 'Electronics', 'Cellphones-and-Accessories', 'Headsets'),
(351, 'Ear-Cup', 'Electronics', 'Cellphones-and-Accessories', 'Headsets'),
(352, 'Ear-Pad', 'Electronics', 'Cellphones-and-Accessories', 'Headsets'),
(353, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(354, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(355, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(356, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(357, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(358, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(359, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(360, 'For-Sony', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(361, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(362, 'For-ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Audio-Docks-and-Speakers'),
(363, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Cases-Covers-and-Skins'),
(364, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Cases-Covers-and-Skins'),
(365, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Cases-Covers-and-Skins'),
(366, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phone-Smartphone-Parts'),
(367, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Cases-Covers-and-Skins'),
(368, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phone-Smartphone-Parts'),
(369, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phone-Smartphone-Parts'),
(370, 'For-Sony', 'Electronics', 'Cellphones-and-Accessories', 'Cases-Covers-and-Skins'),
(371, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Cases-Covers-and-Skins'),
(372, 'For-ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Cases-Covers-and-Skins'),
(373, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(374, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(375, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(376, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(377, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(378, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(379, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(380, 'For-Sony', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(381, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(382, 'For-ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Screen-Protectors'),
(383, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(384, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(385, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(386, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(387, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(388, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(389, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(390, 'For-Sony', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(391, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(392, 'For-ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Chargers-Cradles'),
(393, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(394, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(395, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(396, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(397, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(398, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(399, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(400, 'For-Sony', 'Electronics', 'Cellphones-and-Accessories', 'Batteries')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(401, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(402, 'For-ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Batteries'),
(403, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(404, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(405, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(406, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(407, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Cell-Phones-and-Smartphones'),
(408, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(409, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(410, 'For-Sony', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(411, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(412, 'For-ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Cable-and-Adapters'),
(413, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(414, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(415, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(416, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(417, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(418, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(419, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(420, 'For-Sony', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(421, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Car-Speakerphones'),
(422, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(423, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(424, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(425, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(426, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(427, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(428, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(429, 'For-Sony', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(430, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(431, 'For-ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Mounts-and-Holders'),
(432, 'For-Apple', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(433, 'For-Samsung', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(434, 'For-LG', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(435, 'For-HTC', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(436, 'For-Motorola', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(437, 'For-Nokia', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(438, 'For-BlackBerry', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(439, 'For-Huawei', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(440, 'For-ZTE', 'Electronics', 'Cellphones-and-Accessories', 'Styluses'),
(441, 'Accessory-Bundles', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(442, 'Armbands', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(443, 'Decals-and-Stickers', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(444, 'FM-Transmitters', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(445, 'Memory-Cards', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(446, 'Memory-Card-Readers-and-Adapters', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(447, 'Port-Dust-Covers', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(448, 'Signal-Boosters', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(449, 'Straps-and-Charms', 'Electronics', 'Cellphones-and-Accessories', 'Cellphone-Accessories'),
(450, 'Canon', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(451, 'Fujifilm', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(452, 'GoPro', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(453, 'Kodak', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(454, 'Nikon', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(455, 'Olympus', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(456, 'Panasonic', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(457, 'Pentax', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(458, 'Samsung', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(459, 'Sony', 'Electronics', 'Cameras-and-Photo', 'Digital-Cameras'),
(460, 'Canon', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(461, 'Leica', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(462, 'Minolta', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(463, 'Nikon', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(464, 'Olympus', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(465, 'Pentax', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(466, 'Sigma', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(467, 'Sony', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(468, 'Tamron', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(469, 'Zeiss', 'Electronics', 'Cameras-and-Photo', 'Lenses-Filters'),
(470, 'Canon', 'Electronics', 'Cameras-and-Photo', 'Camcorders'),
(471, 'GoPro', 'Electronics', 'Cameras-and-Photo', 'Camcorders'),
(472, 'JVC', 'Electronics', 'Cameras-and-Photo', 'Camcorders'),
(473, 'Panasonic', 'Electronics', 'Cameras-and-Photo', 'Camcorders'),
(474, 'Samsung', 'Electronics', 'Cameras-and-Photo', 'Camcorders'),
(475, 'Sony', 'Electronics', 'Cameras-and-Photo', 'Camcorders'),
(476, 'Vivitar', 'Electronics', 'Cameras-and-Photo', 'Camcorders'),
(477, 'Bushnell', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(478, 'Celestron', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(479, 'Meade', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(480, 'Nikon', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(481, 'Olympus', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(482, 'Pentax', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(483, 'Steiner', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(484, 'Tasco', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(485, 'Vivitar', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(486, 'Zeiss', 'Electronics', 'Cameras-and-Photo', 'Binoculars-Telescopes'),
(487, 'Canon', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(488, 'Godox', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(489, 'Konica-Minolta', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(490, 'Metz', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(491, 'Nikon', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(492, 'Olympus', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(493, 'Pentax', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(494, 'SUNPAK', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(495, 'Vivitar', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(496, 'YongNuo', 'Electronics', 'Cameras-and-Photo', 'Flashes-and-Flash-Accessories'),
(497, 'For-Canon', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports'),
(498, 'For-Fujifilm', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports'),
(499, 'For-GoPro', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports'),
(500, 'For-Nikon', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(501, 'For-Olympus', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports'),
(502, 'For-Panasonic', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports'),
(503, 'For-Pentax', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports'),
(504, 'For-Samsung', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports'),
(505, 'For-Sony', 'Electronics', 'Cameras-and-Photo', 'Tripods-and-Supports'),
(506, 'Background-Material', 'Electronics', 'Cameras-and-Photo', 'Lighting-and-Studio'),
(507, 'Continuous-Lighting', 'Electronics', 'Cameras-and-Photo', 'Lighting-and-Studio'),
(508, 'Flash-Lighting', 'Electronics', 'Cameras-and-Photo', 'Lighting-and-Studio'),
(509, 'Light-Stand-and-Boom-Accessories', 'Electronics', 'Cameras-and-Photo', 'Lighting-and-Studio'),
(510, 'Props-and-Stage-Equipment', 'Electronics', 'Cameras-and-Photo', 'Lighting-and-Studio'),
(511, 'Shooting-Tables-and-Light-Tents', 'Electronics', 'Cameras-and-Photo', 'Lighting-and-Studio'),
(512, 'Darkroom-and-Developing', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(513, 'Film-Cameras', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(514, 'Film', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(515, 'Lens-Boards', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(516, 'Motor-Drives-and-Winders', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(517, 'Movie-Cameras', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(518, 'Movie-Camera-Accessories', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(519, 'Movie-Editing-Equipment', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(520, 'Rangefinder-Units-and-Accs', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(521, 'Slide-and-Movie-Projection', 'Electronics', 'Cameras-and-Photo', 'Film-Photography'),
(522, 'Audio-for-Video', 'Electronics', 'Cameras-and-Photo', 'Video-Production-Editing'),
(523, 'Editing-and-Post-Production', 'Electronics', 'Cameras-and-Photo', 'Video-Production-Editing'),
(524, 'Recorders-and-Players', 'Electronics', 'Cameras-and-Photo', 'Video-Production-Editing'),
(525, 'Switchers-and-Routers', 'Electronics', 'Cameras-and-Photo', 'Video-Production-Editing'),
(526, 'Video-Monitors', 'Electronics', 'Cameras-and-Photo', 'Video-Production-Editing'),
(527, 'Batteries', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(528, 'Cables-and-Adapters', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(529, 'Cases-Bags-and-Covers', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(530, 'Chargers-and-Cradles', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(531, 'Memory-Cards', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(532, 'Microphones', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(533, 'Photo-Albums-and-Storage', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(534, 'Remotes-and-Shutter-Releases', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(535, 'Screen-Protectors', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(536, 'Underwater-Cases-and-Housings', 'Electronics', 'Cameras-and-Photo', 'Camera-and-Photo-Accessories'),
(537, 'Accessory-Bundles', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(538, 'A/V-Cables-and-Adapters', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(539, 'Cases-Covers-Keyboard-Folios', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(540, 'Chargers-and-Sync-Cables', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(541, 'Docking-Stations/Keyboards', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(542, 'Memory-Card-and-USB-Adapters', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(543, 'Mounts-Stands-and-Holders', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(544, 'Reading-Lights', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(545, 'Screen-Protectors', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(546, 'Stickers-and-Decals', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(547, 'Styluses', 'Electronics', 'Computers-and-Tablets', 'iPad-Tablet-eBook-Accessories'),
(548, 'Apple-Laptops', 'Electronics', 'Computers-and-Tablets', 'Laptops-and-Netbooks'),
(549, 'PC-Laptops-and-Netbooks', 'Electronics', 'Computers-and-Tablets', 'Laptops-and-Netbooks'),
(550, 'Apple-Desktops-and-All-In-Ones', 'Electronics', 'Computers-and-Tablets', 'Desktops-and-All-In-Ones'),
(551, 'PC-Desktops-and-All-In-Ones', 'Electronics', 'Computers-and-Tablets', 'Desktops-and-All-In-Ones'),
(552, 'Case-Mods-Stickers-and-Decals', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(553, 'Computer-Speakers', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(554, 'Headsets', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(555, 'Keyboard-Protectors', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(556, 'Laptop-Add-On-Cards', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(557, 'Laptop-Batteries', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(558, 'Laptop-Cases-and-Bags', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(559, 'Laptop-Cooling-Pads', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(560, 'Laptop-Docking-Stations', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(561, 'Laptop-Power-Adapters/Chargers', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(562, 'Memory-Card-Readers-and-Adapters', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(563, 'Mouse-Pads-and-Wrist-Rests', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(564, 'Screen-Protectors', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(565, 'Webcams', 'Electronics', 'Computers-and-Tablets', 'Laptop-and-Desktop-Accessories'),
(566, 'Audio-Cables-and-Adapters', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(567, 'Cable-Testers', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(568, 'Cable-Ties-and-Organizers', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(569, 'Cabling-Tools', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(570, 'Drive-Cables-and-Adapters', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(571, 'FireWire-Cables-and-Adapters', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(572, 'KVM-Switches-and-KVM-Cables', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(573, 'Monitor/AV-Cables-and-Adapters', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(574, 'Networking-Cables-and-Adapters', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(575, 'Parallel-Serial-and-PS/2', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(576, 'Power-Cables-and-Connectors', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(577, 'USB-Cables-Hubs-and-Adapters', 'Electronics', 'Computers-and-Tablets', 'Cables-and-Connectors'),
(578, 'Computer-Cases-and-Accessories', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(579, 'CPUs-Processors', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(580, 'Fans-Heatsinks-and-Cooling', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(581, 'Graphics-Video-Cards', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(582, 'Interface-Add-On-Cards', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(583, 'Laptop-Replacement-Parts', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(584, 'Memory-RAM', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(585, 'Motherboards', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(586, 'Motherboard-and-CPU-Combos', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(587, 'Motherboard-Components-and-Accs', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(588, 'Power-Supplies', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(589, 'Power-Supply-Testers', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(590, 'Sound-Cards-Internal', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(591, 'Video-Capture-and-TV-Tuner-Cards', 'Electronics', 'Computers-and-Tablets', 'Computer-Components-and-Parts'),
(592, 'CD-DVD-and-Blu-ray-Drives', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(593, 'CD-DVD-and-Blu-ray-Duplicators', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(594, 'Drive-Bay-Caddies', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(595, 'Drive-Enclosures-and-Docks', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(596, 'Floppy-Zip-and-Jaz-Drives', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(597, 'Hard-Drives', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(598, 'Hard-Drive-Duplicators', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(599, 'Tape-and-Data-Cartridge-Drives', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(600, 'USB-Flash-Drives', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(601, 'Blank-Media-and-Accessories', 'Electronics', 'Computers-and-Tablets', 'Drives-Storage-and-Blank-Media'),
(602, 'CSUs/DSUs', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(603, 'Directional-Antennas', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(604, 'Enterprise-Routers', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(605, 'Enterprise-Router-Components', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(606, 'Firewall-and-VPN-Devices', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(607, 'Load-Balancers', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(608, 'Network-Storage-Disk-Arrays', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(609, 'Racks-Chassis-and-Patch-Panels', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(610, 'Servers-Clients-and-Terminals', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(611, 'Server-Components', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(612, 'Switches-and-Hubs', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(613, 'VoIP-Business-Phones-IP-PBX', 'Electronics', 'Computers-and-Tablets', 'Enterprise-Networking-Servers'),
(614, 'Boosters-Extenders-and-Antennas', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(615, 'Mobile-Broadband-Devices', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(616, 'Modems', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(617, 'Modem-Router-Combos', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(618, 'Powerline-Networking', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(619, 'USB-Bluetooth-Adapters/Dongles', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(620, 'USB-Wi-Fi-Adapters/Dongles', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(621, 'VoIP-Home-Phones', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(622, 'VoIP-Phone-Adapters', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(623, 'Wired-Routers', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(624, 'Wireless-Access-Points', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(625, 'Wireless-Routers', 'Electronics', 'Computers-and-Tablets', 'Home-Networking-and-Connectivity'),
(626, 'Graphics-Tablets/Boards-and-Pens', 'Electronics', 'Computers-and-Tablets', 'Keyboards-Mice-and-Pointing'),
(627, 'Keyboards-and-Keypads', 'Electronics', 'Computers-and-Tablets', 'Keyboards-Mice-and-Pointing'),
(628, 'Keyboard-and-Mouse-Bundles', 'Electronics', 'Computers-and-Tablets', 'Keyboards-Mice-and-Pointing'),
(629, 'Mice-Trackballs-and-Touchpads', 'Electronics', 'Computers-and-Tablets', 'Keyboards-Mice-and-Pointing'),
(630, 'Remote-Controls-and-Pointers', 'Electronics', 'Computers-and-Tablets', 'Keyboards-Mice-and-Pointing'),
(631, 'Monitors', 'Electronics', 'Computers-and-Tablets', 'Monitors-Projectors-and-Accs'),
(632, 'Projectors', 'Electronics', 'Computers-and-Tablets', 'Monitors-Projectors-and-Accs'),
(633, 'Monitor-Mounts-and-Stands', 'Electronics', 'Computers-and-Tablets', 'Monitors-Projectors-and-Accs'),
(634, 'Monitor-Power-Supplies', 'Electronics', 'Computers-and-Tablets', 'Monitors-Projectors-and-Accs'),
(635, 'Monitor-Replacement-Parts', 'Electronics', 'Computers-and-Tablets', 'Monitors-Projectors-and-Accs'),
(636, 'Projector-Parts-and-Accessories', 'Electronics', 'Computers-and-Tablets', 'Monitors-Projectors-and-Accs'),
(637, 'Power-Distribution-Units', 'Electronics', 'Computers-and-Tablets', 'Power-Protection-Distribution'),
(638, 'Power-Inverters', 'Electronics', 'Computers-and-Tablets', 'Power-Protection-Distribution'),
(639, 'Surge-Protectors-Power-Strips', 'Electronics', 'Computers-and-Tablets', 'Power-Protection-Distribution'),
(640, 'Uninterruptible-Power-Supplies', 'Electronics', 'Computers-and-Tablets', 'Power-Protection-Distribution'),
(641, 'UPS-Batteries-and-Components', 'Electronics', 'Computers-and-Tablets', 'Power-Protection-Distribution'),
(642, 'Printers', 'Electronics', 'Computers-and-Tablets', 'Printers-Scanners-and-Supplies'),
(643, 'Scanners', 'Electronics', 'Computers-and-Tablets', 'Printers-Scanners-and-Supplies'),
(644, 'Ink-Toner-and-Paper', 'Electronics', 'Computers-and-Tablets', 'Printers-Scanners-and-Supplies'),
(645, 'Parts-and-Accessories', 'Electronics', 'Computers-and-Tablets', 'Printers-Scanners-and-Supplies'),
(646, 'Garmin', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Units'),
(647, 'Magellan', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Units'),
(648, 'Rand-McNally', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Units'),
(649, 'TomTom', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Units'),
(650, 'Unbranded/Generic', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Units'),
(651, 'Garmin', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Accessories-and-Tracking'),
(652, 'RAM-Mounts', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Accessories-and-Tracking'),
(653, 'Richter', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Accessories-and-Tracking'),
(654, 'TomTom', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Accessories-and-Tracking'),
(655, 'Unbranded/Generic', 'Electronics', 'Vehicle-Electronics-and-GPS', 'GPS-Accessories-and-Tracking'),
(656, 'RoadPro', 'Electronics', 'Vehicle-Electronics-and-GPS', '12-Volt-Portable-Appliances'),
(657, 'Unbranded/Generic', 'Electronics', 'Vehicle-Electronics-and-GPS', '12-Volt-Portable-Appliances'),
(658, 'WAGAN', 'Electronics', 'Vehicle-Electronics-and-GPS', '12-Volt-Portable-Appliances'),
(659, 'Avital', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Alarms-and-Security'),
(660, 'Compustar', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Alarms-and-Security'),
(661, 'Directed-Electronics', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Alarms-and-Security'),
(662, 'Unbranded/Generic', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Alarms-and-Security'),
(663, 'XpressKit', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Alarms-and-Security'),
(664, 'Alpine', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Audio'),
(665, 'American-International', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Audio'),
(666, 'JVC', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Audio'),
(667, 'Kenwood', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Audio'),
(668, 'KICKER', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Audio'),
(669, 'Pioneer', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Audio'),
(670, 'Rockford-Fosgate', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Audio'),
(671, 'Sony', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Audio'),
(672, 'Alpine', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Video'),
(673, 'American-International', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Video'),
(674, 'Boss', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Video'),
(675, 'JVC', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Video'),
(676, 'Kenwood', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Video'),
(677, 'Pioneer', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Video'),
(678, 'Sony', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Video'),
(679, 'Unbranded/Generic', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Video'),
(680, 'JVC', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Electronics-Accessories'),
(681, 'Kenwood', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Electronics-Accessories'),
(682, 'Pioneer', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Electronics-Accessories'),
(683, 'Sony', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Electronics-Accessories'),
(684, 'Unbranded/Generic', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Car-Electronics-Accessories'),
(685, 'Boss', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(686, 'Clarion', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(687, 'JBL', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(688, 'JL-Audio', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(689, 'Kenwood', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(690, 'KICKER', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(691, 'Pyle', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(692, 'Rockford-Fosgate', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(693, 'Beltronics', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Radar-and-Laser-Detectors'),
(694, 'Cobra', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Radar-and-Laser-Detectors'),
(695, 'Escort', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(696, 'Unbranded/Generic', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Marine-Audio'),
(697, 'Uniden', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Radar-and-Laser-Detectors'),
(698, 'Valentine-One', 'Electronics', 'Vehicle-Electronics-and-GPS', 'Radar-and-Laser-Detectors'),
(699, 'Bath-Caddies-and-Storage', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(700, 'Bathmats-Rugs-and-Toilet-Covers', 'Home-and-Garden', 'Bath', 'Accessory-Sets')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(701, 'Medicine-Cabinets', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(702, 'Mirrors', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(703, 'Non-Slip-Appliques-and-Mats', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(704, 'Scales', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(705, 'Shelves', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(706, 'Shower-Curtains', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(707, 'Shower-Curtain-Hooks', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(708, 'Soap-Dishes-and-Dispensers', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(709, 'Tissue-Box-Covers', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(710, 'Toilet-Brushes-and-Sets', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(711, 'Toilet-Paper-Storage-and-Covers', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(712, 'Toothbrush-Holders', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(713, 'Towels-and-Washcloths', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(714, 'Tumblers', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(715, 'Wall-Hooks-and-Hangers', 'Home-and-Garden', 'Bath', 'Accessory-Sets'),
(716, 'Bathmats-Rugs-and-Toilet-Covers', 'Home-and-Garden', 'Bath', 'Bathmats-Rugs-and-Toilet-Covers'),
(717, 'Shower-Curtains', 'Home-and-Garden', 'Bath', 'Shower-Curtains'),
(718, 'Soap-Dishes-and-Dispensers', 'Home-and-Garden', 'Bath', 'Soap-Dishes-and-Dispensers'),
(719, 'Toothbrush-Holders', 'Home-and-Garden', 'Bath', 'Toothbrush-Holders'),
(720, 'Towels-and-Washcloths', 'Home-and-Garden', 'Bath', 'Towels-and-Washcloths'),
(721, 'Bed-in-a-Bag', 'Home-and-Garden', 'Bedding', 'Pillows'),
(722, 'Bed-Skirts', 'Home-and-Garden', 'Bedding', 'Pillows'),
(723, 'Blankets-and-Throws', 'Home-and-Garden', 'Bedding', 'Pillows'),
(724, 'Canopies-and-Netting', 'Home-and-Garden', 'Bedding', 'Pillows'),
(725, 'Comforters-and-Sets', 'Home-and-Garden', 'Bedding', 'Pillows'),
(726, 'Decorative-Bed-Pillows', 'Home-and-Garden', 'Bedding', 'Pillows'),
(727, 'Duvet-Covers-and-Sets', 'Home-and-Garden', 'Bedding', 'Pillows'),
(728, 'Mattress-Pads-and-Feather-Beds', 'Home-and-Garden', 'Bedding', 'Pillows'),
(729, 'Pillow-Shams', 'Home-and-Garden', 'Bedding', 'Pillows'),
(730, 'Quilts-Bedspreads-and-Coverlets', 'Home-and-Garden', 'Bedding', 'Pillows'),
(731, 'Sheets-and-Pillowcases', 'Home-and-Garden', 'Bedding', 'Pillows'),
(732, 'Bed-Skirts', 'Home-and-Garden', 'Bedding', 'Skirts'),
(733, 'Blankets-and-Throws', 'Home-and-Garden', 'Bedding', 'Blankets-and-Throws'),
(734, 'Comforters-and-Bedding-Sets', 'Home-and-Garden', 'Bedding', 'Comforters-and-Sets'),
(735, 'Duvet-Covers-and-Bedding-Sets', 'Home-and-Garden', 'Bedding', 'Duvet-Covers-and-Sets'),
(736, 'Mattress-Pads-and-Feather-Beds', 'Home-and-Garden', 'Bedding', 'Mattress-Pads-and-Feather-Beds'),
(737, 'Pillow-Shams', 'Home-and-Garden', 'Bedding', 'Pillow-Shams'),
(738, 'Quilts-Bedspreads-and-Coverlets', 'Home-and-Garden', 'Bedding', 'Quilts-Bedspreads-and-Coverlets'),
(739, 'Sheets-and-Pillowcases', 'Home-and-Garden', 'Bedding', 'Sheets-and-Pillowcases'),
(740, 'Candles', 'Home-and-Garden', 'Home-Decorators', 'Candles'),
(741, 'Candle-Holders-and-Accessories', 'Home-and-Garden', 'Home-Decorators', 'Candle-Holders-and-Accessories'),
(742, 'Alarm-Clocks', 'Home-and-Garden', 'Home-Decorators', 'Clocks'),
(743, 'Desk-Mantel-and-Shelf-Clocks', 'Home-and-Garden', 'Home-Decorators', 'Clocks'),
(744, 'Grandfather-Clocks', 'Home-and-Garden', 'Home-Decorators', 'Clocks'),
(745, 'Wall-Clocks', 'Home-and-Garden', 'Home-Decorators', 'Clocks'),
(746, 'Replacement-Parts-and-Tools', 'Home-and-Garden', 'Home-Decorators', 'Clocks'),
(747, 'Decals-Stickers-and-Vinyl-Art', 'Home-and-Garden', 'Home-Decorators', 'Decals-Stickers-and-Vinyl-Art'),
(748, 'Decorative-Pillows', 'Home-and-Garden', 'Home-Decorators', 'Decorative-Pillows'),
(749, 'Air-Fresheners', 'Home-and-Garden', 'Home-Decorators', 'Home-Fragrances'),
(750, 'Catalytic-Fragrance-Lamps', 'Home-and-Garden', 'Home-Decorators', 'Home-Fragrances'),
(751, 'Essential-Oils-and-Diffusers', 'Home-and-Garden', 'Home-Decorators', 'Home-Fragrances'),
(752, 'Incense', 'Home-and-Garden', 'Home-Decorators', 'Home-Fragrances'),
(753, 'Incense-Burners', 'Home-and-Garden', 'Home-Decorators', 'Home-Fragrances'),
(754, 'Potpourri', 'Home-and-Garden', 'Home-Decorators', 'Home-Fragrances'),
(755, 'Ceiling-Fans', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(756, 'Chandeliers-and-Ceiling-Fixtures', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(757, 'Lamp-Shades', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(758, 'Lamps', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(759, 'Light-Bulbs', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(760, 'Night-Lights', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(761, 'String-Lights-Fairy-Lights', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(762, 'Wall-Fixtures', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(763, 'Lighting-Parts-and-Accessories', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(764, 'Lighting', 'Home-and-Garden', 'Home-Decorators', 'Lighting'),
(765, 'Photo-Frames', 'Home-and-Garden', 'Home-Decorators', 'Photo-Frames'),
(766, 'Plaques-and-Signs', 'Home-and-Garden', 'Home-Decorators', 'Plaques-and-Signs'),
(767, 'Posters-and-Prints', 'Home-and-Garden', 'Home-Decorators', 'Posters-and-Prints'),
(768, 'Rugs-and-Carpets', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(769, 'Area-Rugs', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(770, 'Carpet-Tiles', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(771, 'Door-Mats-and-Floor-Mats', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(772, 'Leather-Fur-and-Sheepskin-Rugs', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(773, 'Runners', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(774, 'Stair-Treads', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(775, 'Wall-to-Wall-Carpeting', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(776, 'Rug-Pads-amd-Accessories', 'Home-and-Garden', 'Home-Decorators', 'Rugs'),
(777, 'Tapestries', 'Home-and-Garden', 'Home-Decorators', 'Tapestries'),
(778, 'Afghans-and-Throw-Blankets', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(779, 'Baskets', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(780, 'Bookends', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(781, 'Bottles', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(782, 'Boxes-Jars-and-Tins', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(783, 'Decorative-Fruit-and-Vegetables', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(784, 'Decorative-Plates-and-Bowls', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(785, 'Display-Easels', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(786, 'Door-Decor', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(787, 'Doorstops', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(788, 'Figurines', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(789, 'Floral-Decor', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(790, 'Globes', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(791, 'Indoor-Fountains', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(792, 'Key-and-Letter-Holders', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(793, 'Masks', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(794, 'Message-Boards-and-Holders', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(795, 'Mirrors', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(796, 'Plate-Racks-and-Hangers', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(797, 'Shadow-Boxes', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(798, 'Suncatchers-and-Mobiles', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(799, 'Tile-Art', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(800, 'Vases', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(801, 'Wall-Pockets', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(802, 'Wall-Sculptures', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(803, 'Wall-Shelves', 'Home-and-Garden', 'Home-Decorators', 'Home-Decor'),
(804, 'Building-Plans-and-Blueprints', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(805, 'Cabinets-and-Cabinet-Hardware', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(806, 'Doors-and-Door-Hardware', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(807, 'Flooring-and-Tiles', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(808, 'Garage-Doors-and-Openers', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(809, 'Lumber-and-Composites', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(810, 'Mailboxes-and-Slots', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(811, 'Nails-Screws-and-Fasteners', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(812, 'Paint-and-Varnish', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(813, 'Painting-Supplies-and-Sprayers', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(814, 'Wallpaper-and-Accessories', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(815, 'Windows-and-Window-Hardware', 'Home-and-Garden', 'Home-Improvement', 'Building-and-Hardware'),
(816, 'Alternative-and-Solar-Energy', 'Home-and-Garden', 'Home-Improvement', 'Electrical-and-Solar'),
(817, 'Circuit-Breakers-and-Fuse-Boxes', 'Home-and-Garden', 'Home-Improvement', 'Electrical-and-Solar'),
(818, 'Connectors-and-Ties', 'Home-and-Garden', 'Home-Improvement', 'Electrical-and-Solar'),
(819, 'Extension-Cords', 'Home-and-Garden', 'Home-Improvement', 'Electrical-and-Solar'),
(820, 'Switch-Plates-and-Outlet-Covers', 'Home-and-Garden', 'Home-Improvement', 'Electrical-and-Solar'),
(821, 'Switches-and-Outlets', 'Home-and-Garden', 'Home-Improvement', 'Electrical-and-Solar'),
(822, 'Air-Conditioners', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(823, 'Air-Filters', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(824, 'Air-Purifiers', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(825, 'Dehumidifiers', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(826, 'Fireplaces-and-Stoves', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(827, 'Furnaces-and-Heating-Systems', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(828, 'Heated-Floor-Mats', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(829, 'Humidifiers', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(830, 'Portable-Fans', 'Home-and-Garden', 'Home-Improvement', 'Electrical-and-Solar'),
(831, 'Space-Heaters', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(832, 'Thermostats', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(833, 'Water-Heaters', 'Home-and-Garden', 'Home-Improvement', 'Heating-Cooling-and-Air'),
(834, 'CCTV-Systems', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(835, 'Fire-Escape-Ladders', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(836, 'Hide-a-Keys', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(837, 'Safes', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(838, 'Security-Cameras', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(839, 'Security-Keypads', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(840, 'Security-Signs-and-Decals', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(841, 'Security-Systems', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(842, 'Sensors-and-Motion-Detectors', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(843, 'Smoke-and-Gas-Detectors', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(844, 'Wireless-Transmitters', 'Home-and-Garden', 'Home-Improvement', 'Home-Security'),
(845, 'Bathtubs', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(846, 'Bidets-and-Toilet-Attachments', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(847, 'Faucets', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(848, 'Garbage-Disposals', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(849, 'Hot-Cold-Water-Dispensers', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(850, 'Pumps', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(851, 'Shower-Curtain-Rods', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(852, 'Shower-Enclosures-and-Doors', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(853, 'Shower-Heads', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(854, 'Shower-Panels-and-Massagers', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(855, 'Sinks', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(856, 'Soap-Dispensers-Mounted', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(857, 'Toilets', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(858, 'Toilet-Paper-Holders-Mounted', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(859, 'Toilet-Seats', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(860, 'Towel-Racks', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(861, 'Valves-Fittings-and-Clamps', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(862, 'Vanities', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(863, 'Water-Filters', 'Home-and-Garden', 'Home-Improvement', 'Plumbing-and-Fixtures'),
(864, 'Bianchi', 'Sporting-Goods', 'Cycling', 'Bicycles'),
(865, 'Cannondale', 'Sporting-Goods', 'Cycling', 'Bicycles'),
(866, 'Diamondback', 'Sporting-Goods', 'Cycling', 'Bicycles'),
(867, 'Giant', 'Sporting-Goods', 'Cycling', 'Bicycles'),
(868, 'GT', 'Sporting-Goods', 'Cycling', 'Bicycles'),
(869, 'SCOTT', 'Sporting-Goods', 'Cycling', 'Bicycles'),
(870, 'Specialized', 'Sporting-Goods', 'Cycling', 'Bicycles'),
(871, 'Trek', 'Sporting-Goods', 'Cycling', 'Bicycles'),
(872, 'BAFANG', 'Sporting-Goods', 'Cycling', 'Electric-Bicycles'),
(873, 'Giant', 'Sporting-Goods', 'Cycling', 'Electric-Bicycles'),
(874, 'Haibike', 'Sporting-Goods', 'Cycling', 'Electric-Bicycles'),
(875, 'PEDEGO', 'Sporting-Goods', 'Cycling', 'Electric-Bicycles'),
(876, 'Bianchi', 'Sporting-Goods', 'Cycling', 'Bicycle-Frames'),
(877, 'Cannondale', 'Sporting-Goods', 'Cycling', 'Bicycle-Frames'),
(878, 'Colnago', 'Sporting-Goods', 'Cycling', 'Bicycle-Frames'),
(879, 'Giant', 'Sporting-Goods', 'Cycling', 'Bicycle-Frames'),
(880, 'SCOTT', 'Sporting-Goods', 'Cycling', 'Bicycle-Frames'),
(881, 'Specialized', 'Sporting-Goods', 'Cycling', 'Bicycle-Frames'),
(882, 'Trek', 'Sporting-Goods', 'Cycling', 'Bicycle-Frames'),
(883, 'Jali-Kabab', 'First-Food', 'Bengali', 'Kabab'),
(884, 'Shami-Kabab', 'First-Food', 'Bengali', 'Kabab'),
(885, 'Chicken-Tikka-Kabab', 'First-Food', 'Bengali', 'Chicken'),
(886, 'BBQ-Chicken ', 'First-Food', 'Bengali', 'Chicken'),
(887, 'Tandoori-Chicken', 'First-Food', 'Bengali', 'Chicken'),
(888, 'Garlic-Chicken', 'First-Food', 'Bengali', 'Chicken'),
(889, 'Chicken-Broast', 'First-Food', 'Bengali', 'Chicken'),
(890, 'Mutton-Tikka-Kabab', 'First-Food', 'Bengali', 'Mutton'),
(891, 'Mutton-Biryani', 'First-Food', 'Bengali', 'Mutton'),
(892, 'Mutton-Curry', 'First-Food', 'Bengali', 'Mutton'),
(893, 'Lemon-Juice', 'First-Food', 'Bengali', 'Juice'),
(894, 'Lemon-Mint-Juice', 'First-Food', 'Bengali', 'Juice'),
(895, 'Mango-Juice', 'First-Food', 'Bengali', 'Juice'),
(896, 'Orange-Mint-Juice', 'First-Food', 'Bengali', 'Juice'),
(897, 'Pineapple-Mint-Juice', 'First-Food', 'Bengali', 'Juice'),
(898, 'Chicken-Keema-Dosa', 'First-Food', 'Indian', 'Dosa'),
(899, 'Vegetable-Dosa', 'First-Food', 'Indian', 'Dosa'),
(900, 'Cheese-Dosa', 'First-Food', 'Indian', 'Dosa')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(901, 'Chicken-Chaat', 'First-Food', 'Bengali', 'Chicken'),
(902, 'Prawn-Puri', 'First-Food', 'Bengali', 'Prawn'),
(903, 'Beef-Tikka', 'First-Food', 'Bengali', 'Beef'),
(904, 'Chicken-Seekh-Kabab', 'First-Food', 'Bengali', 'Kabab'),
(905, 'Beef-Seekh-Kabab', 'First-Food', 'Bengali', 'Kabab'),
(906, 'Chana-Puri', 'First-Food', 'Bengali', 'Puri'),
(907, 'Chicken-Pakora', 'First-Food', 'Bengali', 'Chicken'),
(908, 'Reshmi-Kabab', 'First-Food', 'Bengali', 'Kabab'),
(909, 'Jali-Kabab', 'First-Food', 'Bengali', 'Kabab'),
(910, 'Chicken-Samosa', 'First-Food', 'Bengali', 'Samosa'),
(911, 'Vegetable-Samosa', 'First-Food', 'Bengali', 'Samosa'),
(912, 'Beef-Samosa', 'First-Food', 'Bengali', 'Samosa'),
(913, 'Chicken-Shashlik', 'First-Food', 'Bengali', 'Shashlik'),
(914, 'Beef-Shashlik', 'First-Food', 'Bengali', 'Shashlik'),
(915, 'French-Fries', 'First-Food', 'Bengali', 'Potato'),
(916, 'King-Prawn-Butterfly', 'First-Food', 'Bengali', 'Prawn'),
(917, 'Chicken-Shawarma', 'First-Food', 'Bengali', 'Shawarma'),
(918, 'Dosa-Keema', 'First-Food', 'Indian', 'Chicken'),
(919, 'Dosa-Chutney', 'First-Food', 'Bengali', 'Chutney'),
(920, 'Keema-Shawarma', 'First-Food', 'Bengali', 'Shawarma'),
(921, 'Chutney-Shawarma', 'First-Food', 'Bengali', 'Shawarma'),
(922, 'BBQ-Wings', 'First-Food', 'Bengali', 'Chicken'),
(923, 'Barbecue-Chicken', 'First-Food', 'Bengali', 'Chicken'),
(924, 'Crispy-Chicken', 'First-Food', 'Bengali', 'Chicken'),
(925, 'Chow-Mein-Chicken', 'First-Food', 'Bengali', 'Chicken'),
(926, 'Chicken-Pop', 'First-Food', 'Bengali', 'Chicken'),
(927, 'Vegetable-Pakora', 'First-Food', 'Bengali', 'Vegetable'),
(928, 'Cassonade-Salad', 'First-Food', 'Bengali', 'Salad'),
(929, 'Potato-Wedges', 'First-Food', 'Bengali', 'Potato'),
(930, 'Nachos', 'First-Food', 'Bengali', 'Nachos'),
(931, 'Buffalo-Wing', 'First-Food', 'Bengali', 'Chicken'),
(932, 'Tempura-Prawns', 'First-Food', 'Bengali', 'Prawn'),
(933, 'Fried-Chicken', 'First-Food', 'Bengali', 'Chicken'),
(934, 'Calamari-Fry', 'First-Food', 'Italian', 'Fish'),
(935, 'Chicken-Cutlet', 'First-Food', 'Bengali', 'Chicken'),
(936, 'Chow-Mein', 'First-Food', 'Bengali', 'Noodles'),
(937, 'Pasta', 'First-Food', 'Bengali', 'Noodles'),
(938, 'Pasta', 'First-Food', 'Bengali', 'Noodles'),
(939, 'Lassi', 'First-Food', 'Bengali', 'Juice'),
(940, 'Grape', 'First-Food', 'Bengali', 'Juice'),
(941, 'Malta', 'First-Food', 'Bengali', 'Juice'),
(942, 'Hot-Coffee', 'First-Food', 'Bengali', 'Coffee'),
(943, 'Cold-Coffee', 'First-Food', 'Bengali', 'Coffee'),
(944, 'Milkshake', 'First-Food', 'Bengali', 'Coffee'),
(945, 'Chocolate-Coffee', 'First-Food', 'Bengali', 'Coffee'),
(946, 'Thai-Soup', 'First-Food', 'Bengali', 'Soup'),
(947, 'Corn-Soup', 'First-Food', 'Bengali', 'Soup'),
(948, 'Mushroom-Soup', 'First-Food', 'Bengali', 'Soup'),
(949, 'Vegetable-Soup', 'First-Food', 'Bengali', 'Soup'),
(950, 'Burger', 'First-Food', 'Bengali', 'Chicken'),
(951, 'Biryani', 'First-Food', 'Bengali', 'Chicken'),
(952, 'Biryani', 'First-Food', 'Bengali', 'Beef'),
(953, 'Biryani', 'First-Food', 'Bengali', 'Mutton'),
(954, 'Biryani', 'First-Food', 'Indian', 'Chicken'),
(955, 'Biryani', 'First-Food', 'Indian', 'Mutton'),
(956, 'Fried-Rice', 'First-Food', 'Bengali', 'Rice'),
(957, 'Fish', 'First-Food', 'Bengali', 'Fish'),
(958, 'T-Bone-Steak', 'First-Food', 'Bengali', 'Beef'),
(959, 'Kala-Bhuna', 'First-Food', 'Bengali', 'Beef'),
(960, 'Chicken-Tikka-Masala', 'First-Food', 'Bengali', 'Chicken'),
(961, 'Chicken-Achari', 'First-Food', 'Bengali', 'Chicken'),
(962, 'Mezbani-Beef', 'First-Food', 'Bengali', 'Beef'),
(963, 'Chicken-Karahi', 'First-Food', 'Bengali', 'Chicken'),
(964, 'Chicken-Bhuna', 'First-Food', 'Bengali', 'Chicken'),
(965, 'Beef-Achari', 'First-Food', 'Bengali', 'Beef'),
(966, 'Beef-Bhuna', 'First-Food', 'Bengali', 'Beef'),
(967, 'Prawn-Dopiaza', 'First-Food', 'Bengali', 'Prawn'),
(968, 'Naan', 'First-Food', 'Bengali', 'Naan'),
(969, 'Parotta', 'First-Food', 'Bengali', 'Parotta'),
(970, 'Luchi', 'First-Food', 'Bengali', 'Luchi'),
(971, 'Mutton-kacchi', 'First-Food', 'Bengali', 'Mutton'),
(972, 'Mutton-tahari', 'First-Food', 'Bengali', 'Mutton'),
(973, 'Morog-polao', 'First-Food', 'Bengali', 'Rice'),
(974, 'Beef-tahari', 'First-Food', 'Bengali', 'Beef'),
(975, 'Hyderabadi-beef-biryani', 'First-Food', 'Bengali', 'Beef'),
(976, 'Chicken-tikka-biryani', 'First-Food', 'Bengali', 'Chicken'),
(977, 'Deem-khichuri', 'First-Food', 'Bengali', 'Rice'),
(978, 'Beef-jhalpiazi', 'First-Food', 'Bengali', 'Beef'),
(979, 'Chicken-jhalpiazi', 'First-Food', 'Bengali', 'Chicken'),
(980, 'Chicken-Butt-Kabab', 'First-Food', 'Bengali', 'Chicken'),
(981, 'Deem-sandwich', 'First-Food', 'Bengali', 'Sandwich'),
(982, 'Chicken-sandwich', 'First-Food', 'Bengali', 'Sandwich'),
(983, 'Beef-burger', 'First-Food', 'Bengali', 'Burger'),
(984, 'Vegetable-burger', 'First-Food', 'Bengali', 'Burger'),
(985, 'Chana-masala', 'First-Food', 'Bengali', 'Chana'),
(986, 'Potato-chana', 'First-Food', 'Bengali', 'Chana'),
(987, 'Onthon', 'First-Food', 'Bengali', 'Onthon'),
(988, 'Vegetable-pizza', 'First-Food', 'Bengali', 'Pizza'),
(989, 'Spicy-chicken-pizza', 'First-Food', 'Bengali', 'Pizza'),
(990, 'Chicken-tikka-pizza', 'First-Food', 'Bengali', 'Pizza'),
(991, 'Chicken-ball', 'First-Food', 'Bengali', 'Chicken'),
(992, 'Green-salad', 'First-Food', 'Bengali', 'Green-salad'),
(993, 'Coca-cola', 'First-Food', 'Bengali', 'Drinks'),
(994, 'Coca-cola', 'First-Food', 'Bengali', 'Drinks'),
(995, '7up', 'First-Food', 'Bengali', 'Drinks'),
(996, 'Minarel-water', 'First-Food', 'Bengali', 'Drinks'),
(997, 'Farm-Chicken-Eggs', 'Grocery', 'Food-and-Beverage', 'Egg'),
(998, 'Duck-Eggs', 'Grocery', 'Food-and-Beverage', 'Egg'),
(999, 'Quail-Eggs', 'Grocery', 'Food-and-Beverage', 'Egg'),
(1000, 'Beef', 'Grocery', 'Food-and-Beverage', 'Meat')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_category_d` (`bay_category_d_id`, `bay_category_d`, `bay_category_a_in_bay_category_d`, `bay_category_b_in_bay_category_d`, `bay_category_c_in_bay_category_d`) VALUES
(1001, 'Mutton', 'Grocery', 'Food-and-Beverage', 'Meat'),
(1002, 'Broiler-Chicken', 'Grocery', 'Food-and-Beverage', 'Meat'),
(1003, 'Duck', 'Grocery', 'Food-and-Beverage', 'Meat'),
(1004, 'Turkey', 'Grocery', 'Food-and-Beverage', 'Meat'),
(1005, 'Swan-Egg', 'Grocery', 'Food-and-Beverage', 'Egg'),
(1006, 'Swan-Meat', 'Grocery', 'Food-and-Beverage', 'Meat'),
(1007, 'Dear-Meat', 'Grocery', 'Food-and-Beverage', 'Meat'),
(1008, 'Shrimp', 'Grocery', 'Food-and-Beverage', 'Fish'),
(1009, 'Salmon', 'Grocery', 'Food-and-Beverage', 'Fish'),
(1010, 'Tuna-Fish', 'Grocery', 'Food-and-Beverage', 'Fish'),
(1011, 'Hilsa-Fish', 'Grocery', 'Food-and-Beverage', 'Fish'),
(1012, 'Rupchanda-Fish', 'Grocery', 'Food-and-Beverage', 'Fish'),
(1013, 'Lobstar-Fish', 'Grocery', 'Food-and-Beverage', 'Fish'),
(1014, 'Tiger-Prawn', 'Grocery', 'Food-and-Beverage', 'Fish'),
(1015, 'Crabs', 'Grocery', 'Food-and-Beverage', 'Fish'),
(1016, 'Loitta-Dry-Fish', 'Grocery', 'Food-and-Beverage', 'Dry-Fish'),
(1017, 'Ghoinna', 'Grocery', 'Food-and-Beverage', 'Dry-Fish'),
(1018, 'Nona-Hilsa', 'Grocery', 'Food-and-Beverage', 'Dry-Fish'),
(1019, 'Chanda', 'Grocery', 'Food-and-Beverage', 'Dry-Fish'),
(1020, 'Dried-Shrimp', 'Grocery', 'Food-and-Beverage', 'Dry-Fish'),
(1021, 'Fazli-Mango', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1022, 'Langra-Mango', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1023, 'Himsagar-Mango', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1024, 'Gopalbhog-Mango', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1025, 'Amrapali-Mango', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1026, 'Sagar-Banana', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1027, 'Sobri-Banana', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1028, 'Bichi-Kola', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1029, 'Kobri-Banana', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1030, 'Champa-Banana', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1031, 'Apple', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1032, 'Orange', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1033, 'Lichi', 'Grocery', 'Food-and-Beverage', 'Fruits'),
(1034, 'Milk-Powder', 'Grocery', 'Food-and-Beverage', 'Dairy-Milk'),
(1035, 'Liquid-Milk', 'Grocery', 'Food-and-Beverage', 'Dairy-Milk'),
(1036, 'Butter', 'Grocery', 'Food-and-Beverage', 'Dairy-Milk'),
(1037, 'Cheese', 'Grocery', 'Food-and-Beverage', 'Dairy-Milk'),
(1038, 'Miniket-Rice', 'Grocery', 'Food-and-Beverage', 'Rice'),
(1039, 'Nagirshail-Rice', 'Grocery', 'Food-and-Beverage', 'Rice'),
(1040, 'Kalijira-Rice', 'Grocery', 'Food-and-Beverage', 'Rice'),
(1041, 'Black-Rice', 'Grocery', 'Food-and-Beverage', 'Rice'),
(1042, 'Basmoti-Rice', 'Grocery', 'Food-and-Beverage', 'Rice'),
(1043, 'Moshur-Puls', 'Grocery', 'Food-and-Beverage', 'Puls'),
(1044, 'Moong-Dal', 'Grocery', 'Food-and-Beverage', 'Puls'),
(1045, 'Master-Oil', 'Grocery', 'Food-and-Beverage', 'Oil-and-Ghee'),
(1046, 'Soyabin-Oil', 'Grocery', 'Food-and-Beverage', 'Oil-and-Ghee'),
(1047, 'Olive-Oil', 'Grocery', 'Food-and-Beverage', 'Oil-and-Ghee'),
(1048, 'Coconut-Oil', 'Grocery', 'Food-and-Beverage', 'Oil-and-Ghee'),
(1049, 'Brawn-Sugar', 'Grocery', 'Food-and-Beverage', 'Sugar'),
(1050, 'White-Sugar', 'Grocery', 'Food-and-Beverage', 'Sugar'),
(1051, 'Salt', 'Grocery', 'Food-and-Beverage', 'Salt'),
(1052, 'Bit-Salt', 'Grocery', 'Food-and-Beverage', 'Salt'),
(1053, 'Testing-Salt', 'Grocery', 'Food-and-Beverage', 'Salt'),
(1054, 'Koli-Flower', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1055, 'Broccoli', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1056, 'Cabbage', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1057, 'Capsicum', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1058, 'Red-Spinach', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1059, 'Pui-Spinach', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1060, 'Palong-Spinach', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1061, 'Green-Chili', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1062, 'Potato', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1063, 'Onion', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1064, 'Garlic', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1065, 'Ginger', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1066, 'Onion', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1067, 'Garlic', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1068, 'Ginger', 'Grocery', 'Food-and-Beverage', 'Vegetable'),
(1069, 'Cloves-Spice', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1070, 'Bay-Leaf', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1071, 'Cardaman-Brown', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1072, 'Cardaman-Green', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1073, 'Cinnanon', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1074, 'Black-Cumin', 'Grocery', 'Food-and-Beverage', 'Hot-Spices'),
(1075, 'Tea', 'Grocery', 'Food-and-Beverage', 'Tea-and-Coffee'),
(1076, 'Coffee', 'Grocery', 'Food-and-Beverage', 'Tea-and-Coffee'),
(1077, 'Green-Tea', 'Grocery', 'Food-and-Beverage', 'Tea-and-Coffee'),
(1078, 'Chips', 'Grocery', 'Food-and-Beverage', 'Bakery-and-Snacks'),
(1079, 'Breads', 'Grocery', 'Food-and-Beverage', 'Bakery-and-Snacks'),
(1080, 'Cookies', 'Grocery', 'Food-and-Beverage', 'Bakery-and-Snacks'),
(1081, 'Mixed-Snack', 'Grocery', 'Food-and-Beverage', 'Bakery-and-Snacks'),
(1082, 'Health-Drink', 'Grocery', 'Food-and-Beverage', 'Beverage'),
(1083, 'Juice', 'Grocery', 'Food-and-Beverage', 'Beverage'),
(1084, 'Soft-Drinks', 'Grocery', 'Food-and-Beverage', 'Beverage'),
(1085, 'Tea', 'Grocery', 'Food-and-Beverage', 'Beverage'),
(1086, 'Coffee', 'Grocery', 'Food-and-Beverage', 'Beverage'),
(1087, 'Water', 'Grocery', 'Food-and-Beverage', 'Beverage'),
(1088, 'Bath', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1089, 'Deodorents', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1090, 'Face-and-Body-Care', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1091, 'Family-Planning', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1092, 'Feminine-Care', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1093, 'First-Aid', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1094, 'Hear-Care', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1095, 'Hand-Wash-and-Sanitizer', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1096, 'Oral-Care', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1097, 'Shaving-Care', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene'),
(1098, 'Skin-Care', 'Grocery', 'Health-and-Beauty', 'Beauty-and-Hygiene')");
}

/*##################################################################################### 
############### UP For Domain and License Verified Users by Auto Update ###############
#################################################################################### */
/*** ***/
public function bay_all_quality_communication_testimonial_rating($productid)
{
$productid = intval($productid);
$query = "SELECT bay_product_id_in_rating, bay_username_buyer_in_rating, bay_rating_for_quality_satisfaction, bay_rating_for_communication_satisfaction, bay_rating_testimonial, bay_rating_date FROM bay_rating_multiple_items WHERE bay_product_id_in_rating=$productid and bay_rating_status='OK'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function bay_count_of_buyer_rating($productid)
{
/*** MySQL 8.0.23 OK ***/
$productid = intval($productid);
$query = "SELECT COUNT(bay_product_id_in_rating) as bay_total_rating, SUM(bay_rating_for_quality_satisfaction)/count( bay_product_id_in_rating ) *20 as bay_quality_rating, SUM(bay_rating_for_communication_satisfaction)/count( bay_product_id_in_rating ) *20 as bay_communi_rating FROM bay_rating_multiple_items where bay_product_id_in_rating=$productid and bay_rating_status='OK'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function update_dhl_price($bay_dhl_weight_zone_price_id, $dhl_price)
{
$bay_dhl_weight_zone_price_id = intval($bay_dhl_weight_zone_price_id);
$dhl_price = floatval($dhl_price);

/* update soft_merchant_add_items */
$query1st = "update bay_dhl_express_worldwide_zone_export_price set dhl_price=$dhl_price where bay_dhl_weight_zone_price_id=$bay_dhl_weight_zone_price_id";
$result1st = eBConDb::eBgetInstance()->eBgetConection()->query($query1st);

if($result1st)
{
/*** ***/
echo $this->ebDone();
}
/*** ***/
}
/*** ***/
public function update_dhl_country_zone($bay_dhl_country_zone_id, $dhl_country_zone)
{
/*** MySQL 8.0.23 OK ***/
$bay_dhl_country_zone_id = intval($bay_dhl_country_zone_id);
$dhl_country_zone = intval($dhl_country_zone);

/* update soft_merchant_add_items */
$query1st = "update country_and_zone set dhl_country_zone=$dhl_country_zone where bay_dhl_country_zone_id=$bay_dhl_country_zone_id";
$result1st = eBConDb::eBgetInstance()->eBgetConection()->query($query1st);

if($result1st)
{
/*** ***/
echo $this->ebDone();
}
/*** ***/
}
/*** ***/
public function edit_dhl_zone_by_id($bay_dhl_zone_edit)
{
/*** MySQL 8.0.23 OK ***/
$bay_dhl_zone_edit = intval($bay_dhl_zone_edit);
$query ="SELECT * FROM country_and_zone";
$query .=" WHERE bay_dhl_country_zone_id=$bay_dhl_zone_edit";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function edit_dhl_export_price($bay_dhl_weight_zone_price_id)
{
/*** MySQL 8.0.23 OK ***/
$bay_dhl_weight_zone_price_id = intval($bay_dhl_weight_zone_price_id);
$query ="SELECT * FROM bay_dhl_express_worldwide_zone_export_price";
$query .=" WHERE bay_dhl_weight_zone_price_id=$bay_dhl_weight_zone_price_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function search_in_bay_dhl_price()
{
if(isset($_REQUEST['submit_search_bay_dhl']))
{
extract($_REQUEST);
$dhl_zone = floatval($_REQUEST['search_bay_dhl_zone']);
$dhl_weight = floatval($_REQUEST['search_bay_weitht']);
$query = "SELECT * FROM bay_dhl_express_worldwide_zone_export_price where dhl_zone=$dhl_zone AND dhl_weight=$dhl_weight";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function dhl_export_rates_by_zone_product()
{
/*** MySQL 8.0.23 OK ***/
$query ="SELECT MAX(bay_dhl_weight_zone_price_id) AS bay_dhl_weight_zone_price_id, dhl_zone, dhl_weight, MAX(dhl_price) AS dhl_price  FROM";
$query .=" bay_dhl_express_worldwide_zone_export_price";
$query .=" GROUP BY dhl_zone, dhl_weight";
$query .=" ORDER BY dhl_zone, dhl_weight";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function search_dhl_rating_zones()
{
$query = "SELECT * FROM";
$query .=" country_and_zone ORDER BY country_name ASC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows=$result->fetch_array())
{
echo "<option value='".$rows['dhl_country_zone']."'>".$this->visulString($rows['country_name'])."</option>"; 
}
}
$result -> free_result();
}
/*** ***/
public function select_admin_shipping_from_country()
{
$query = "SELECT * FROM";
$query .=" bay_dhl_express_worldwide_admin_shipping_zone";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function dhl_rating_zones()
{
$query = "SELECT * FROM";
$query .=" country_and_zone";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function approve_the_image_bay_multi($bay_multi_image_id)
{
$bay_multi_image_id = intval($bay_multi_image_id);
$bay_image_approved =1;

/* update soft_merchant_add_items */
$query1st = "update bay_merchant_multi_img set bay_image_approved=$bay_image_approved where bay_multi_image_id=$bay_multi_image_id";
$result1st = eBConDb::eBgetInstance()->eBgetConection()->query($query1st);

if($result1st)
{ 
/*** ***/
echo $this->ebDone();
}
/*** ***/
}
/*** ***/
public function not_approve_the_image_bay_multi($bay_multi_image_id,$bay_big_imag_url)
{
$bay_multi_image_id = intval($bay_multi_image_id);
$bay_image_approved =3;
$bay_big_imag_url = str_replace(hostingName, docRoot, hypertext.$bay_big_imag_url);
if(!empty($bay_big_imag_url))
{
unlink($bay_big_imag_url); 
}
/* update soft_merchant_add_items */
$query1st = "update bay_merchant_multi_img set bay_image_approved=$bay_image_approved, bay_big_imag_url='' where bay_multi_image_id=$bay_multi_image_id";
$result1st = eBConDb::eBgetInstance()->eBgetConection()->query($query1st);

if($result1st)
{
/*** ***/
echo $this->ebDone();	
}
/*** ***/
}
/*** ***/
public function reject_the_image_bay_multi($bay_multi_image_id,$bay_big_imag_url)
{
$bay_multi_image_id = intval($bay_multi_image_id);
$bay_image_approved =3;
$bay_big_imag_url = str_replace(hostingName, docRoot, hypertext.$bay_big_imag_url);
if(!empty($bay_big_imag_url))
{
unlink($bay_big_imag_url); 
}
/* update soft_merchant_add_items */
$query1st = "update bay_merchant_multi_img set bay_image_approved=$bay_image_approved, bay_big_imag_url='' where bay_multi_image_id=$bay_multi_image_id";
$result1st = eBConDb::eBgetInstance()->eBgetConection()->query($query1st);

if($result1st)
{
/*** ***/
echo $this->ebDone();
}
/*** ***/
}
/*** ***/
public function screenShootCount($bay_merchant_add_items_id)
{
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$query ="SELECT * FROM";
$query .=" bay_merchant_multi_img";
$query .=" WHERE add_items_id_in_bay_merchant_multi_img=$bay_merchant_add_items_id AND bay_image_approved=1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result <= 3)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function bay_multi_img_admin_review($bay_merchant_add_items_id)
{
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$query ="SELECT * FROM";
$query .=" bay_merchant_multi_img";
$query .=" WHERE add_items_id_in_bay_merchant_multi_img=$bay_merchant_add_items_id AND bay_image_approved=0 ORDER BY bay_multi_image_id DESC";
$query .=" LIMIT 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function insert_bay_multi_image_url($bay_merchant_add_items_id,$bay_big_imag_url)
{
/* Do not use target='_blank', it will not remove the image */
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
/*** ***/
if(!empty($bay_big_imag_url))
{ 
$query1st = "INSERT INTO bay_merchant_multi_img set add_items_id_in_bay_merchant_multi_img=$bay_merchant_add_items_id, bay_image_approved=0, bay_big_imag_url='$bay_big_imag_url'";
$result1st = eBConDb::eBgetInstance()->eBgetConection()->query($query1st);
/*** ***/
$query2nd = "update bay_merchant_add_items set m_product_approved=0 where bay_merchant_add_items_id=$bay_merchant_add_items_id";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2nd);
/*** ***/
$query3rd = "update bay_showroom_approved_items set s_product_approved=0 where bay_showroom_approved_items_id=$bay_merchant_add_items_id";
$result3rd = eBConDb::eBgetInstance()->eBgetConection()->query($query3rd);

/*** ***/
if($result3rd)
{
/*** ***/
echo $this->ebDone();
?>
<script>
window.location.replace('bay-merchants-items-view.php');
</script>
<?php
}
}
}
/*** ***/
public function BaydeleteScreenShootMerchant($bay_multi_image_id, $add_items_id_in_bay_merchant_multi_img, $m_og_image_url) 
{
$bay_multi_image_id = intval($bay_multi_image_id);
$bay_multi_image_id = intval($add_items_id_in_bay_merchant_multi_img);
$m_og_image_url = str_replace(hostingName, docRoot, hypertext.$m_og_image_url);
if(!empty($m_og_image_url))
{
unlink($m_og_image_url);
}

$query1st = "UPDATE bay_merchant_multi_img SET bay_image_approved=0 WHERE bay_multi_image_id=$bay_multi_image_id";
eBConDb::eBgetInstance()->eBgetConection()->query($query1st);
$query2nd = "UPDATE bay_showroom_approved_items SET s_product_approved=0 WHERE bay_showroom_approved_items_id=$bay_multi_image_id";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2nd);
$query3 = "update bay_merchant_add_items m_product_approved=3, m_og_image_url='' where bay_merchant_add_items_id=$bay_multi_image_id";
$result3 = eBConDb::eBgetInstance()->eBgetConection()->query($query3);
if($result3)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function bay_multi_img($bay_merchant_add_items_id)
{
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$query ="SELECT * FROM";
$query .=" bay_merchant_multi_img";
$query .=" WHERE add_items_id_in_bay_merchant_multi_img=$bay_merchant_add_items_id ORDER BY bay_multi_image_id DESC";
/*** $query .= " limit 1"; ***/
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_image_from_bay()
{
/* Read to Edit */
if(isset($_REQUEST['bay_upload_image']))
{
extract($_REQUEST);
$bay_merchant_add_items_id = intval($_REQUEST['bay_merchant_add_items_id']);
$query = "SELECT * FROM";
$query .=" bay_merchant_add_items";
$query .=" where bay_merchant_add_items_id=$bay_merchant_add_items_id";
$query .=" limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}

/*** ***/
public function return_value_of_admin_dhl_shipping_zone_country_name_for_cart()
{
$from_shipping_zone = 0;
$query = "SELECT * FROM bay_dhl_express_worldwide_admin_shipping_zone";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while ($row = $result->fetch_array()) 
{
$from_admin_country_name = $row['admin_country_name'];
}
return $from_admin_country_name;
}
$result -> free_result();
}
	
/*** ***/
public function return_value_admin_dhl_shipping_country_id_for_cart()
{
$from_shipping_country = 0;
$query = "SELECT * FROM bay_dhl_express_worldwide_admin_shipping_zone";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if ($num_result == 1)
{
while ($row = $result->fetch_array()) 
{
$from_shipping_country = intval($row['admin_dhl_country_id']);
}
return $from_shipping_country;
}
$result -> free_result();
}

/*** ***/
public function return_value_admin_dhl_shipping_zone_id_for_cart()
{
$from_shipping_zone = 0;
$query = "SELECT * FROM bay_dhl_express_worldwide_admin_shipping_zone";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if ($num_result == 1)
{
while ($row = $result->fetch_array()) 
{
$from_shipping_zone = intval($row['admin_dhl_zone_id']);
}
return $from_shipping_zone;
}
$result -> free_result();
}
/*** ***/
public function merchant_country_of_origin($m_country_of_origin)
{
$m_country_of_origin = intval($m_country_of_origin);
$query = "SELECT * FROM country_and_zone WHERE bay_dhl_country_zone_id=$m_country_of_origin";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function submit_admin_dhl_shipping_country_id($admin_dhl_shipping_country_id)
{
$admin_dhl_shipping_country_id = intval($admin_dhl_shipping_country_id);
/*** ***/
$query1 = "SELECT * FROM  country_and_zone WHERE bay_dhl_country_zone_id=$admin_dhl_shipping_country_id";
$testresult1 = eBConDb::eBgetInstance()->eBgetConection()->query($query1);
$adminShipmentInfo = mysqli_fetch_array($testresult1);
$admin_dhl_zone_id = intval($adminShipmentInfo['dhl_country_zone']);
$admin_country_name = $adminShipmentInfo['country_name'];
/*** ***/
$query2 = "SELECT * FROM bay_dhl_express_worldwide_admin_shipping_zone";
$result2 = eBConDb::eBgetInstance()->eBgetConection()->query($query2);
$num_result2 = $result2->num_rows;
if($num_result2 == 0)
{
$query3 = "INSERT INTO bay_dhl_express_worldwide_admin_shipping_zone SET admin_dhl_zone_id=$admin_dhl_zone_id, admin_dhl_country_id=$admin_dhl_shipping_country_id, admin_country_name='$admin_country_name'";
$result3 = eBConDb::eBgetInstance()->eBgetConection()->query($query3);
if($result3)
{
/*** ***/
echo $this->ebDone();
}	
}
}
/*** ***/
public function select_country_of_admin_shipping_zone()
{
$query ="SELECT * FROM";
$query .=" country_and_zone";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows = $result->fetch_array())
{
echo "<option value='".$rows['bay_dhl_country_zone_id']."'>".$rows['country_name']."</option>"; 
}
}
$result -> free_result();
}

/*** ***/
public function admin_dhl_shipping_zone()
{
/*** MySQL 8.0.23 OK ***/
$query = "SELECT * FROM bay_dhl_express_worldwide_admin_shipping_zone";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_shipping_address_from_bay_dhl_country_name()
{
if(isset($_SESSION['shipping_country_id']))
{
$country_id = $_SESSION['shipping_country_id'];
$query ="SELECT * FROM";
$query .=" country_and_zone";
$query .=" WHERE bay_dhl_country_zone_id=$country_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function select_shipping_address_from_bay_dhl_country_id()
{
$query ="SELECT * FROM";
$query .=" country_and_zone";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function shippingto($shipping_zone)
{
if(isset($_POST['receiver_country']))
{
unset($_SESSION['shipping_zone']);
unset($_SESSION['shipping_country_id']);
$_SESSION['shipping_country_id'] = $receiver_country = $_POST['receiver_country'];
$_SESSION['shipping_zone'] = $this->select_shipping_address_from_bay_dhl_express_worldwide_country_zone($receiver_country);
}
}
/*** ***/
public function select_shipping_address_from_bay_dhl_express_worldwide_country_zone($receiver_country)
{
$query ="SELECT * FROM";
$query .=" country_and_zone";
$query .=" where bay_dhl_country_zone_id=$receiver_country";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows=$result->fetch_array())
{
return $rows['dhl_country_zone']; 
}
}
$result -> free_result();
}
/*** ***/
public function total_shipment($cart)
{
$shipment_price = 0.00;
if(is_array($cart))
{
foreach ($cart as $id => $qty)
{
$shipment_weight =	$this->item_weight($id);
$zone = $_SESSION['shipping_zone'];
$shipment_price_query = "SELECT * FROM bay_dhl_express_worldwide_zone_export_price WHERE dhl_zone=$zone AND dhl_weight=$shipment_weight";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($shipment_price_query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
$item_price = number_format($row['dhl_price'],2,'.','');
$shipment_price += $item_price;
}
return $shipment_price;
}
$result -> free_result();
}
}
}
/*** ***/
public function item_weight($id)
{
$id = intval($id);
$weight = 0.00;

$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id = $id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
$item_weight = floatval(number_format($row['s_weight'],2,'.',''));
$quentity = $_SESSION['cart'][$id];
$weight += $item_weight * $quentity;
if($weight <= 0.50)
{ 
$weight += (0.50 - $weight); 
return number_format($weight,1,'.','');
}
elseif($weight > 25)
{ 
echo "Weitht 25 Kg exist for this product.";
unset($_SESSION['cart'][$id]);
}
else
{
return number_format($weight,0,'.','');
}
}
}
$result -> free_result();
}
/*** ***/
public function selected_shipping_country_dial_code_check()
{
$country_id = $_SESSION['shipping_country_id'];
$query = "SELECT * FROM";
$query .=" country_and_zone";
$query .=" where bay_dhl_country_zone_id=$country_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows=$result->fetch_array())
{
return $rows['country_code']; 
}
}
$result -> free_result();
}
/*** ***/
public function selected_shipping_country_dial_code()
{
$country_id = $_SESSION['shipping_country_id'];
$query ="SELECT * FROM";
$query .=" country_and_zone";
$query .=" where bay_dhl_country_zone_id=$country_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows=$result->fetch_array())
{
echo $rows['country_code']; 
}
}
$result -> free_result();
}
/*** ***/
public function selected_shipping_country_dhl()
{
$country_id = $_SESSION['shipping_country_id'];
$query ="SELECT * FROM";
$query .=" country_and_zone";
$query .=" where bay_dhl_country_zone_id=$country_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows=$result->fetch_array())
{
echo $rows['country_name']; 
}
}
$result -> free_result();
}
/*** ***/
public function select_item_dhl_price($id)
{
$id = intval($id);
$itemWeight = $this->item_weight($id);
$zone = $_SESSION['shipping_zone']; 
$query ="SELECT * FROM";
$query .=" bay_dhl_express_worldwide_zone_export_price";
$query .=" WHERE dhl_zone=$zone AND dhl_weight=$itemWeight";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows=$result->fetch_array())
{
return floatval(number_format($rows['dhl_price'],2,'.',''));
}
}
}
/* ###################################### CRM Default  ########################################################### */
public function submit_new_shipping_address($full_name_sa, $address_line_1_sa, $address_line_2_sa, $city_town_sa, $state_province_region_sa, $postal_code_sa, $phone_mobile_sa, $country_sa)
{
/*** MySQL 8.0.23 OK ***/
$username = $_SESSION['ebusername'];
$tracking_unique_sales_order_sa = $_SESSION['order_tracking_unique_id'];
$geolocation_latitude = 0;
$geolocation_longitude = 0;
/*** ***/
$query_shipping_address = "INSERT INTO bay_shipping_address_crm SET username_buyer_sa='$username', tracking_unique_sales_order_sa='$tracking_unique_sales_order_sa', full_name_sa='$full_name_sa', address_line_1_sa='$address_line_1_sa', address_line_2_sa='$address_line_2_sa', city_town_sa='$city_town_sa', state_province_region_sa='$state_province_region_sa', postal_code_sa='$postal_code_sa', phone_mobile_sa='$phone_mobile_sa', country_sa='$country_sa', geolocation_latitude='$geolocation_latitude', geolocation_longitude='$geolocation_longitude'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query_shipping_address);	
}
/* Start Simplify Payment */
/*** ***/
public function submit_new_order_simplify($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_io = $_SESSION['ebusername'];
$tracking_unique_sales_order_io = $_SESSION['order_tracking_unique_id'];
$tracking_unique_product_io = $_POST['tracking_unique_product_ai_'.$i];
$bay_showroom_approved_items_id_io = intval($_POST['item_number_'.$i]);
$sqtn_io = intval($_POST['quantity_'.$i]);
$size_io = $_POST['size_'.$i];
$item_total_price_io = floatval(number_format($_POST['item_total_price_'.$i],2,'.',''));
$item_total_handling_io = floatval(number_format($_POST['handling_'.$i],2,'.',''));
$item_total_tax_vat_io = floatval(number_format($_POST['tax_'.$i],2,'.',''));
$item_total_shipping_io = floatval(number_format($_POST['shipping_'.$i],2,'.',''));
$sdate_io = date("Y-m-d H:i:s");
$username_salseman_io = "";
$username_merchant_io = $_POST['username_merchant_'.$i];
/*** ***/
$query_unique_inventory = "INSERT INTO bay_items_order_crm SET username_buyer_io='$username_buyer_io', tracking_unique_sales_order_io='$tracking_unique_sales_order_io', tracking_unique_product_io='$tracking_unique_product_io', bay_showroom_approved_items_id_io=$bay_showroom_approved_items_id_io, sqtn_io=$sqtn_io, size_io='$size_io', item_total_price_io=$item_total_price_io, item_total_handling_io=$item_total_handling_io, item_total_tax_vat_io=$item_total_tax_vat_io, item_total_shipping_io=$item_total_shipping_io, sdate_io='$sdate_io', username_salseman_io='$username_salseman_io', username_merchant_io='$username_merchant_io', payment_status='NO'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query_unique_inventory);
}
}
/*** ***/
public function bay_order_m2m_crm_simplify($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_product_id = intval($_POST['item_number_'.$i]);
$username_buyer = $_SESSION['ebusername'];
$username_merchant = $_POST['username_merchant_'.$i];
$tracking_unique_sales_order = $_SESSION['order_tracking_unique_id'];
$query_shipment_prove = "INSERT INTO bay_order_m2m_for_crm set bay_appro_id_in_order_m2m=$bay_product_id, username_buyer_in_m2m_for_crm='$username_buyer', username_merchant_in_m2m_for_crm='$username_merchant', tracking_unique_sales_order_in_m2m='$tracking_unique_sales_order', payment_status='NO'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_shipment_prove);
}
}
/*** ***/
public function submit_new_order_auto_stock_update_simplify($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_sr = $_SESSION['ebusername'];
$tracking_unique_sales_order_sr = $_SESSION['order_tracking_unique_id'];
$tracking_unique_product_sr = $_POST['tracking_unique_product_ai_'.$i];
$bay_showroom_approved_items_id_sr = intval($_POST['item_number_'.$i]);
$sqtn_io = intval($_POST['quantity_'.$i]);
$item_total_price_io = floatval(number_format($_POST['item_total_price_'.$i],2, '.', ''));
$item_total_tax_vat_io = floatval(number_format($_POST['tax_'.$i],2, '.', ''));
$size_sr = $_POST['size_'.$i];
$sdate_sr = date("Y-m-d H:i:s");
$username_salse_sr = "";
$username_merchant_sr = $_POST['username_merchant_'.$i];
$payment_status ="NO";
/*** ***/
$queryOne = "INSERT INTO bay_salse_report_stock_update SET username_buyer_sr='$username_buyer_sr', tracking_unique_sales_order_sr='$tracking_unique_sales_order_sr', tracking_unique_product_sr='$tracking_unique_product_sr', bay_showroom_approved_items_id_sr=$bay_showroom_approved_items_id_sr, sqtn_sr=$sqtn_io, item_total_price_sr=$item_total_price_io, item_total_tax_sr=$item_total_tax_vat_io, size_sr='$size_sr', sdate_sr='$sdate_sr', username_salse_sr='$username_salse_sr', username_merchant_sr='$username_merchant_sr', payment_status='$payment_status'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryOne);
}
}
/* Create Shipment Prove initial entry for PayPal Payment in bay_shipment_prove_crm table */
public function shipment_prove_gross_crm_simplify($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_spg = $_SESSION['ebusername'];
$tracking_unique_sales_order_spg = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_prove_crm = intval($_POST['item_number_'.$i]);
$username_merchant_spg = $_POST['username_merchant_'.$i];
$query_shipment_prove = "INSERT INTO bay_shipment_prove_crm set username_buyer_spg='$username_buyer_spg', tracking_unique_sales_order_spg='$tracking_unique_sales_order_spg', bay_product_id_in_prove_crm=$bay_product_id_in_prove_crm, shipment_date_spg='', courier_service_name_spg='', tracking_number_courier_services_spg='', username_merchant_spg='$username_merchant_spg', payment_status='NO', handover_delevery_status='NO', origin_product_2client='NO'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query_shipment_prove);
}
}
/*** ***/
public function returns_refunds_crm_simplify($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_rrg = $_SESSION['ebusername'];
$username_merchant_rrg = $_POST['username_merchant_'.$i];
$tracking_unique_sales_order_rrg = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_returns_refunds_crm = intval($_POST['item_number_'.$i]);
/*** ***/
$total_qtn_crm = intval($_POST['quantity_'.$i]);
$return_qtn_crm = 0;
$item_total_price = floatval(number_format($_POST['item_total_price_'.$i],2,'.',''));
$item_total_handling = floatval(number_format($_POST['handling_'.$i],2,'.',''));
$item_total_tax_vat = floatval(number_format($_POST['tax_'.$i],2,'.',''));
$item_total_shipping = floatval(number_format($_POST['shipping_'.$i],2,'.',''));
/* Change Total Refund As your Company Policy 
$total_refund = $item_total_price + $item_total_handling + $item_total_shipping + $item_total_tax_vat;
*/
$total_refund = $item_total_price;
$purchase_date = date("Y-m-d H:i:s");
$currency = primaryCurrency;
$query_returns_refunds = "INSERT INTO bay_returns_refunds_crm set username_buyer_rrg='$username_buyer_rrg', username_merchant_rrg='$username_merchant_rrg', tracking_unique_sales_order_rrg='$tracking_unique_sales_order_rrg', bay_product_id_in_returns_refunds_crm=$bay_product_id_in_returns_refunds_crm, returns_refunds_comment_rrg='', return_size_crm='', total_qtn_crm=$total_qtn_crm, return_qtn_crm=$return_qtn_crm, total_refund_with_shipment_without_texvat=$total_refund, return_refund_total_crm=0.00, purchase_date='$purchase_date', now_date='', request_date='', received_return_item='NO', request_status='NO', payment_status='NO', payment_method='simplify', payment_currency='$currency'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_returns_refunds);
}
}
/*** ***/
public function support_crm_simplify($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_order_tracking_id = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_buyer_support = intval($_POST['item_number_'.$i]);
$bay_username_buyer_seller = $_SESSION['ebusername'];
$bay_username_seller = $_POST['username_merchant_'.$i];
$bay_buyer_payment_status = 'NO';
$bay_support_buyer_post_date = date("Y-m-d H:i:s");
$query_support = "INSERT INTO bay_buyer_support_multiple_items SET bay_order_tracking_id='$bay_order_tracking_id', bay_product_id_in_buyer_support=$bay_product_id_in_buyer_support, bay_username_buyer_seller='$bay_username_seller', bay_username_seller='$bay_username_seller', bay_support_requirements='Hello, Any Query?', bay_support_buyer_post_date='$bay_support_buyer_post_date', bay_buyer_payment_status='$bay_buyer_payment_status'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_support);
}
}
/*** ***/
public function review_crm_simplify($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_product_id_in_rating = intval($_POST['item_number_'.$i]);
$bay_tracking_order_id_in_rating = $_SESSION['order_tracking_unique_id'];
$bay_username_buyer_in_rating = $_SESSION['ebusername'];
$query_review = "INSERT INTO bay_rating_multiple_items SET bay_product_id_in_rating='$bay_product_id_in_rating', bay_tracking_order_id_in_rating='$bay_tracking_order_id_in_rating', bay_username_buyer_in_rating='$bay_username_buyer_in_rating', bay_rating_for_quality_satisfaction=5, bay_rating_for_communication_satisfaction=5, bay_rating_testimonial='', bay_rating_status='NO', bay_rating_date=''";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_review);
}
}
/*** ***/
public function sales_commission_simplify($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
//
$username_buyer_paypal = $_SESSION['ebusername'];
//
if(isset($_SESSION['omrebusername']))
{
$username_saler_sales_comm = $_SESSION['omrebusername'];
}
else
{
$username_saler_sales_comm = 0;
}
//
$queryReferrer = "SELECT omrusername FROM  excessusers WHERE ebusername='$username_saler_sales_comm'";
$queryReferrerResult = eBConDb::eBgetInstance()->eBgetConection()->query($queryReferrer);
$referrerInfo = mysqli_fetch_array($queryReferrerResult);
$username_referrer = isset($referrerInfo['omrusername']);
//
$order_tracking_unique_paypal = $_SESSION['order_tracking_unique_id'];
$bay_id_in_paypal = intval(preg_replace('#[^0-9]#i','',$_POST['item_number_'.$i]));
$bay_product_qtn_paypal = intval(preg_replace('#[^0-9]#i','',$_POST['quantity_'.$i]));
/** VVI Please Check bay_sub_total_price_bk  **/
$bay_sub_total_price_paypal = floatval(number_format($_POST['item_total_price_'.$i],2,'.',''));
$total_sales_commissions = floatval(number_format(($bay_sub_total_price_paypal * 25)/100,2, '.', ''));
$total_commi_level_first = floatval(number_format(($bay_sub_total_price_paypal * 5)/100,2, '.', ''));
$payment_status = "NO";
$payment_date = date("Y-m-d H:i:s");
//
$queryCommiBay = "INSERT INTO bay_product_sales_commissions set username_buyer_sales_comm='$username_buyer_paypal', username_saler_sales_comm='$username_saler_sales_comm', username_referrer='$username_referrer', tracking_unique_sales_comm='$order_tracking_unique_paypal', bay_product_id=$bay_id_in_paypal, bay_product_qtn_sales_comm=$bay_product_qtn_paypal, total_price_per_item=$bay_sub_total_price_paypal, total_commi_self=$total_sales_commissions, total_commi_level_first=$total_commi_level_first, bkash_tranjaction_sales_comm='', payment_status='$payment_status', sales_date='$payment_date', self_payment_status='NO', ref_payment_status='NO', payment_through_paypal_bkash='simplify', paid_through_paypal_bkash='', ref_paid_through_paypal_bkash='', self_payment_date='', ref_payment_date='', self_tranjaction_id='', ref_tranjaction_id=''";
$resultCommi = eBConDb::eBgetInstance()->eBgetConection()->query($queryCommiBay);
}
}
/*** ***/
public function bay_symplify_payment_gross_crm($param)
{
foreach ($param as $key => $value)
:
$value = urlencode(stripslashes($value));
/*** ***/
$username_buyer_pg = $_SESSION["ebusername"];
$tracking_unique_sales_order_pg = $_SESSION["order_tracking_unique_id"];
$txn_id_pg = $param['paymentId'];
$mc_gross_pg = intval(number_format($param['amount'],2,'',''));
$mc_currency_pg = $param['currency'];
$payment_status_pg = $param['paymentStatus'];
$first_name_pg = '';
$last_name_pg = '';
$payer_email_pg = '';
$payment_date_pg = $param['paymentDate'];
$payment_fee_pg = 0.00;
endforeach;
/*** ***/
$query_simplify_payment = "INSERT INTO bay_payment_gross_crm SET username_buyer_pg='$username_buyer_pg', tracking_unique_sales_order_pg='$tracking_unique_sales_order_pg', txn_id_pg='$txn_id_pg', mc_gross_pg=$mc_gross_pg, mc_currency_pg='$mc_currency_pg', payment_status_pg='$payment_status_pg', first_name_pg='$first_name_pg', last_name_pg='$last_name_pg', payer_email_pg='$payer_email_pg', payment_date_pg='$payment_date_pg', payment_fee_pg=$payment_fee_pg";
eBConDb::eBgetInstance()->eBgetConection()->query($query_simplify_payment);
}
/*** ***/
public function bay_simplify_payment_crm()
{
if(isset($_REQUEST['paymentStatus']) == 'APPROVED')
{
$this->bay_symplify_payment_gross_crm($_REQUEST);
$payment_status = 'OK';

/* Using Tranjaction */
eBConDb::eBgetInstance()->eBgetConection()->autocommit(false);
$order_tracking_id = $_SESSION['order_tracking_unique_id'];
$username_buyer = $_SESSION['ebusername'];
/* Update Order M2M */
$queryTwo = "UPDATE bay_order_m2m_for_crm SET payment_status='$payment_status' where tracking_unique_sales_order_in_m2m='$order_tracking_id' and username_buyer_in_m2m_for_crm='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryTwo);	
/* Update for Sales Report and Stock Update */
$queryThree = "UPDATE bay_salse_report_stock_update SET payment_status='$payment_status' where tracking_unique_sales_order_sr='$order_tracking_id' and username_buyer_sr='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryThree);
/* Update Order */
$queryFour = "UPDATE bay_items_order_crm SET payment_status='$payment_status' where tracking_unique_sales_order_io='$order_tracking_id' and username_buyer_io='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryFour);
/* Update for Shipment Prove */
$queryFive = "UPDATE bay_shipment_prove_crm SET payment_status='$payment_status' where tracking_unique_sales_order_spg='$order_tracking_id' and username_buyer_spg='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryFive);
/* Update for Return and Refund */
$querySix = "UPDATE bay_returns_refunds_crm SET payment_status='$payment_status' where tracking_unique_sales_order_rrg='$order_tracking_id' and username_buyer_rrg='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($querySix);
/* Update for Support */
$querySeven = "UPDATE bay_buyer_support_multiple_items SET bay_buyer_payment_status='$payment_status' where bay_order_tracking_id='$order_tracking_id' and bay_username_buyer_seller='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($querySeven);
/* Update for Ratings */
$queryEight = "UPDATE bay_rating_multiple_items SET bay_rating_status='$payment_status' where bay_tracking_order_id_in_rating='$order_tracking_id' and bay_username_buyer_in_rating='$username_buyer'";
$resultEignt = eBConDb::eBgetInstance()->eBgetConection()->query($queryEight);
/* Update for Sales Commission */
$queryNine = "UPDATE bay_product_sales_commissions SET payment_status='$payment_status' WHERE tracking_unique_sales_comm='$order_tracking_id' AND username_buyer_sales_comm='$username_buyer'";
$resultNine = eBConDb::eBgetInstance()->eBgetConection()->query($queryNine);

if(!$resultNine)
{ 
eBConDb::eBgetInstance()->eBgetConection()->rollback();
echo "<div class='well'><b>Sorry, Something wrong with your payment.</b></div>";
}
else
{
echo "<div class='well'><b>Your payment has been completed, Thank you for your purchase.</b></div>";
/**##############**/
$username_buyer = $_SESSION['ebusername'];
$queryNine = "SELECT email FROM excessusers WHERE ebusername='$username_buyer'";
$resultNine = eBConDb::eBgetInstance()->eBgetConection()->query($queryNine);
$resultNineInfo = mysqli_fetch_array($resultNine);
$buyer_email = $resultNineInfo['email'];
/*** ***/
$mailPaypal = new PHPMailer(true);
try
{
//
$mailPaypal->isSMTP();
//$mailPaypal->SMTPDebug = SMTP::DEBUG_SERVER;
$mailPaypal->Host = smtpHost;
$mailPaypal->SMTPAuth   = true;
$mailPaypal->Username   = smtpUsername;
$mailPaypal->Password   = smtpPassword;
/* For port 587 and TLS */
$mailPaypal->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mailPaypal->Port = smtpPort;
//
$mailPaypal->setFrom(adminEmail, domain);
$mailPaypal->addAddress($buyer_email);
$mailPaypal->isHTML(true);
//$mailPaypal->addAttachment('');
$mailPaypal->Subject = "Your simplify payment confirmation";
//
$message ="<html>";
$message .="<head>";
$message .="<title>We have received your simplify payment</title>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>Hi $username_buyer, We have received your simplify payment</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outBayLinkFull."/user-purchase-history.php";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View your purchase history</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
//
$mailPaypal->Body = $message;
//
$mailPaypal->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$mailPaypal->ErrorInfo}";
}
/*** ***/
}
eBConDb::eBgetInstance()->eBgetConection()->commit();
}
}
/* End Simplify Payment */
/*** ***/
public function submit_new_order($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_io = $_SESSION['ebusername'];
$tracking_unique_sales_order_io = $_SESSION['order_tracking_unique_id'];
$tracking_unique_product_io = $_POST['tracking_unique_product_ai_'.$i];
$bay_showroom_approved_items_id_io = intval($_POST['item_number_'.$i]);
$sqtn_io = intval($_POST['quantity_'.$i]);
$size_io = $_POST['size_'.$i];
$item_total_price_io = floatval(number_format($_POST['item_total_price_'.$i],2,'.',''));
$item_total_handling_io = floatval(number_format($_POST['handling_'.$i],2,'.',''));
$item_total_tax_vat_io = floatval(number_format($_POST['tax_'.$i],2,'.',''));
$item_total_shipping_io = floatval(number_format($_POST['shipping_'.$i],2,'.',''));
$sdate_io = date("Y-m-d H:i:s");
$username_salseman_io = "";
$username_merchant_io = $_POST['username_merchant_'.$i];
/*** ***/
$query_unique_inventory = "INSERT INTO bay_items_order_crm SET username_buyer_io='$username_buyer_io', tracking_unique_sales_order_io='$tracking_unique_sales_order_io', tracking_unique_product_io='$tracking_unique_product_io', bay_showroom_approved_items_id_io=$bay_showroom_approved_items_id_io, sqtn_io=$sqtn_io, size_io='$size_io', item_total_price_io=$item_total_price_io, item_total_handling_io=$item_total_handling_io, item_total_tax_vat_io=$item_total_tax_vat_io, item_total_shipping_io=$item_total_shipping_io, sdate_io='$sdate_io', username_salseman_io='$username_salseman_io', username_merchant_io='$username_merchant_io', payment_status='NO'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query_unique_inventory);
}
}
/*** ***/
public function submit_new_order_bkash($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_io = $_SESSION['ebusername'];
$tracking_unique_sales_order_io = $_SESSION['order_tracking_unique_id'];
$tracking_unique_product_io = $_POST['tracking_unique_product_ai_'.$i];
$bay_showroom_approved_items_id_io = intval($_POST['item_number_'.$i]);
$sqtn_io = intval($_POST['quantity_'.$i]);
$size_io = $_POST['size_'.$i];
$item_total_price_io = floatval(number_format($_POST['item_total_price_'.$i],0,'.',''));
$item_total_handling_io = floatval(number_format($_POST['handling_'.$i],0,'.',''));
$item_total_tax_vat_io = floatval(number_format($_POST['tax_'.$i],0,'.',''));
$item_total_shipping_io = floatval(number_format($_POST['shipping_'.$i],0,'.',''));
$sdate_io = date("Y-m-d H:i:s");
$username_salseman_io = "";
$username_merchant_io = $_POST['username_merchant_'.$i];
/*** ***/
$query_unique_inventory = "INSERT INTO bay_items_order_crm SET username_buyer_io='$username_buyer_io', tracking_unique_sales_order_io='$tracking_unique_sales_order_io', tracking_unique_product_io='$tracking_unique_product_io', bay_showroom_approved_items_id_io=$bay_showroom_approved_items_id_io, sqtn_io=$sqtn_io, size_io='$size_io', item_total_price_io=$item_total_price_io, item_total_handling_io=$item_total_handling_io, item_total_tax_vat_io=$item_total_tax_vat_io, item_total_shipping_io=$item_total_shipping_io, sdate_io='$sdate_io', username_salseman_io='$username_salseman_io', username_merchant_io='$username_merchant_io', payment_status='NO'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query_unique_inventory);
}
}
/*** ***/
public function bay_order_m2m_crm($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_product_id = intval($_POST['item_number_'.$i]);
$username_buyer = $_SESSION['ebusername'];
$username_merchant = $_POST['username_merchant_'.$i];
$tracking_unique_sales_order = $_SESSION['order_tracking_unique_id'];
$query_shipment_prove = "INSERT INTO bay_order_m2m_for_crm set bay_appro_id_in_order_m2m=$bay_product_id, username_buyer_in_m2m_for_crm='$username_buyer', username_merchant_in_m2m_for_crm='$username_merchant', tracking_unique_sales_order_in_m2m='$tracking_unique_sales_order', payment_status='NO'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_shipment_prove);
}
}
/*** ***/
public function bay_order_m2m_crm_bkash($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_product_id = intval($_POST['item_number_'.$i]);
$username_buyer = $_SESSION['ebusername'];
$username_merchant = $_POST['username_merchant_'.$i];
$tracking_unique_sales_order = $_SESSION['order_tracking_unique_id'];
$query_shipment_prove = "INSERT INTO bay_order_m2m_for_crm set bay_appro_id_in_order_m2m=$bay_product_id, username_buyer_in_m2m_for_crm='$username_buyer', username_merchant_in_m2m_for_crm='$username_merchant', tracking_unique_sales_order_in_m2m='$tracking_unique_sales_order', payment_status='NO'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_shipment_prove);
}
}
/*** ***/
public function submit_new_order_auto_stock_update($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_sr = $_SESSION['ebusername'];
$tracking_unique_sales_order_sr = $_SESSION['order_tracking_unique_id'];
$tracking_unique_product_sr = $_POST['tracking_unique_product_ai_'.$i];
$bay_showroom_approved_items_id_sr = intval($_POST['item_number_'.$i]);
$sqtn_io = intval($_POST['quantity_'.$i]);
$item_total_price_io = floatval(number_format($_POST['item_total_price_'.$i],2, '.', ''));
$item_total_tax_vat_io = floatval(number_format($_POST['tax_'.$i],2, '.', ''));
$size_sr = $_POST['size_'.$i];
$sdate_sr = date("Y-m-d H:i:s");
$username_salse_sr = "";
$username_merchant_sr = $_POST['username_merchant_'.$i];
$payment_status ="NO";
/*** ***/
$queryOne = "INSERT INTO bay_salse_report_stock_update SET username_buyer_sr='$username_buyer_sr', tracking_unique_sales_order_sr='$tracking_unique_sales_order_sr', tracking_unique_product_sr='$tracking_unique_product_sr', bay_showroom_approved_items_id_sr=$bay_showroom_approved_items_id_sr, sqtn_sr=$sqtn_io, item_total_price_sr=$item_total_price_io, item_total_tax_sr=$item_total_tax_vat_io, size_sr='$size_sr', sdate_sr='$sdate_sr', username_salse_sr='$username_salse_sr', username_merchant_sr='$username_merchant_sr', payment_status='$payment_status'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryOne);
}
}
/*** ***/
public function submit_new_order_auto_stock_update_bkash($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_sr = $_SESSION['ebusername'];
$tracking_unique_sales_order_sr = $_SESSION['order_tracking_unique_id'];
$tracking_unique_product_sr = $_POST['tracking_unique_product_ai_'.$i];
$bay_showroom_approved_items_id_sr = intval($_POST['item_number_'.$i]);
$sqtn_io = intval($_POST['quantity_'.$i]);
$item_total_price_io = floatval(number_format($_POST['item_total_price_'.$i],0, '.', ''));
$item_total_tax_vat_io = floatval(number_format($_POST['tax_'.$i],0, '.', ''));
$size_sr = $_POST['size_'.$i];
$sdate_sr = date("Y-m-d H:i:s");
$username_salse_sr = "";
$username_merchant_sr = $_POST['username_merchant_'.$i];
$payment_status ="NO";
/*** ***/
$queryOne = "INSERT INTO bay_salse_report_stock_update SET username_buyer_sr='$username_buyer_sr', tracking_unique_sales_order_sr='$tracking_unique_sales_order_sr', tracking_unique_product_sr='$tracking_unique_product_sr', bay_showroom_approved_items_id_sr=$bay_showroom_approved_items_id_sr, sqtn_sr=$sqtn_io, item_total_price_sr=$item_total_price_io, item_total_tax_sr=$item_total_tax_vat_io, size_sr='$size_sr', sdate_sr='$sdate_sr', username_salse_sr='$username_salse_sr', username_merchant_sr='$username_merchant_sr', payment_status='$payment_status'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryOne);
}
}
/* Create Shipment Prove initial entry for PayPal Payment in bay_shipment_prove_crm table */
public function shipment_prove_gross_crm($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_spg = $_SESSION['ebusername'];
$tracking_unique_sales_order_spg = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_prove_crm = intval($_POST['item_number_'.$i]);
$username_merchant_spg = $_POST['username_merchant_'.$i];
$query_shipment_prove = "INSERT INTO bay_shipment_prove_crm set username_buyer_spg='$username_buyer_spg', tracking_unique_sales_order_spg='$tracking_unique_sales_order_spg', bay_product_id_in_prove_crm=$bay_product_id_in_prove_crm, shipment_date_spg='', courier_service_name_spg='', tracking_number_courier_services_spg='', username_merchant_spg='$username_merchant_spg', payment_status='NO', handover_delevery_status='NO', origin_product_2client='NO'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query_shipment_prove);
}
}
/*****/
public function shipment_prove_gross_crm_bkash($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_spg = $_SESSION['ebusername'];
$tracking_unique_sales_order_spg = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_prove_crm = intval($_POST['item_number_'.$i]);
$username_merchant_spg = $_POST['username_merchant_'.$i];
$query_shipment_prove = "INSERT INTO bay_shipment_prove_crm set username_buyer_spg='$username_buyer_spg', tracking_unique_sales_order_spg='$tracking_unique_sales_order_spg', bay_product_id_in_prove_crm=$bay_product_id_in_prove_crm, shipment_date_spg='', courier_service_name_spg='', tracking_number_courier_services_spg='', username_merchant_spg='$username_merchant_spg', payment_status='NO', handover_delevery_status='NO', origin_product_2client='NO'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query_shipment_prove);
}
}
/*** ***/
public function returns_refunds_crm($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_rrg = $_SESSION['ebusername'];
$username_merchant_rrg = $_POST['username_merchant_'.$i];
$tracking_unique_sales_order_rrg = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_returns_refunds_crm = intval($_POST['item_number_'.$i]);
/*** ***/
$total_qtn_crm = intval($_POST['quantity_'.$i]);
$return_qtn_crm = 0;
$item_total_price = floatval(number_format($_POST['item_total_price_'.$i],2,'.',''));
$item_total_handling = floatval(number_format($_POST['handling_'.$i],2,'.',''));
$item_total_tax_vat = floatval(number_format($_POST['tax_'.$i],2,'.',''));
$item_total_shipping = floatval(number_format($_POST['shipping_'.$i],2,'.',''));
/* Change Total Refund As your Company Policy 
$total_refund = $item_total_price + $item_total_handling + $item_total_shipping + $item_total_tax_vat;
*/
$total_refund = $item_total_price;
$purchase_date = date("Y-m-d H:i:s");
$currency = primaryTosecondary;
$query_returns_refunds = "INSERT INTO bay_returns_refunds_crm set username_buyer_rrg='$username_buyer_rrg', username_merchant_rrg='$username_merchant_rrg', tracking_unique_sales_order_rrg='$tracking_unique_sales_order_rrg', bay_product_id_in_returns_refunds_crm=$bay_product_id_in_returns_refunds_crm, returns_refunds_comment_rrg='', return_size_crm='', total_qtn_crm=$total_qtn_crm, return_qtn_crm=$return_qtn_crm, total_refund_with_shipment_without_texvat=$total_refund, return_refund_total_crm=0.00, purchase_date='$purchase_date', now_date='', request_date='', received_return_item='NO', request_status='NO', payment_status='NO', payment_method='PayPal', payment_currency='$currency'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_returns_refunds);
}
}
/*** ***/
public function returns_refunds_crm_bkash($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$username_buyer_rrg = $_SESSION['ebusername'];
$username_merchant_rrg = $_POST['username_merchant_'.$i];
$tracking_unique_sales_order_rrg = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_returns_refunds_crm = intval($_POST['item_number_'.$i]);
/*** ***/
$total_qtn_crm = intval($_POST['quantity_'.$i]);
$return_qtn_crm = 0;
$item_total_price = floatval(number_format(primaryTosecondary * $_POST['item_total_price_'.$i],0,'.',''));
$item_total_handling = floatval(number_format(primaryTosecondary * $_POST['handling_'.$i],0,'.',''));
$item_total_tax_vat = floatval(number_format(primaryTosecondary * $_POST['tax_'.$i],0,'.',''));
$item_total_shipping = floatval(number_format(primaryTosecondary * $_POST['shipping_'.$i],0,'.',''));
/* Change Total Refund As your Company Policy 
$total_refund = $item_total_price + $item_total_handling + $item_total_shipping + $item_total_tax_vat;
*/
$total_refund = $item_total_price;
$purchase_date = date("Y-m-d H:i:s");
$secondaryCurrency = secondaryCurrency;
$query_returns_refunds = "INSERT INTO bay_returns_refunds_crm set username_buyer_rrg='$username_buyer_rrg', username_merchant_rrg='$username_merchant_rrg', tracking_unique_sales_order_rrg='$tracking_unique_sales_order_rrg', bay_product_id_in_returns_refunds_crm=$bay_product_id_in_returns_refunds_crm, returns_refunds_comment_rrg='', return_size_crm='', total_qtn_crm=$total_qtn_crm, return_qtn_crm=$return_qtn_crm, total_refund_with_shipment_without_texvat=$total_refund, return_refund_total_crm=0.00, purchase_date='$purchase_date', now_date='', request_date='', received_return_item='NO', request_status='NO', payment_status='NO', payment_method='bKash', payment_currency='$secondaryCurrency'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_returns_refunds);
}
}
/*** ***/
public function support_crm($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_order_tracking_id = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_buyer_support = intval($_POST['item_number_'.$i]);
$bay_username_buyer_seller = $_SESSION['ebusername'];
$bay_username_seller = $_POST['username_merchant_'.$i];
$bay_buyer_payment_status = 'NO';
$bay_support_buyer_post_date = date("Y-m-d H:i:s");
$query_support = "INSERT INTO bay_buyer_support_multiple_items SET bay_order_tracking_id='$bay_order_tracking_id', bay_product_id_in_buyer_support=$bay_product_id_in_buyer_support, bay_username_buyer_seller='$bay_username_seller', bay_username_seller='$bay_username_seller', bay_support_requirements='Hello, Any Query?', bay_support_buyer_post_date='$bay_support_buyer_post_date', bay_buyer_payment_status='$bay_buyer_payment_status'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_support);
}
}
/*** ***/
public function support_crm_bkash($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_order_tracking_id = $_SESSION['order_tracking_unique_id'];
$bay_product_id_in_buyer_support = intval($_POST['item_number_'.$i]);
$bay_username_buyer_seller = $_SESSION['ebusername'];
$bay_username_seller = $_POST['username_merchant_'.$i];
$bay_buyer_payment_status = 'NO';
$bay_support_buyer_post_date = date("Y-m-d H:i:s");
$query_support = "INSERT INTO bay_buyer_support_multiple_items SET bay_order_tracking_id='$bay_order_tracking_id', bay_product_id_in_buyer_support=$bay_product_id_in_buyer_support, bay_username_buyer_seller='$bay_username_seller', bay_username_seller='$bay_username_seller', bay_support_requirements='Hello, Any Query?', bay_support_buyer_post_date='$bay_support_buyer_post_date', bay_buyer_payment_status='$bay_buyer_payment_status'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_support);
}
}
/*** ***/
public function review_crm($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_product_id_in_rating = intval($_POST['item_number_'.$i]);
$bay_tracking_order_id_in_rating = $_SESSION['order_tracking_unique_id'];
$bay_username_buyer_in_rating = $_SESSION['ebusername'];
$query_review = "INSERT INTO bay_rating_multiple_items SET bay_product_id_in_rating='$bay_product_id_in_rating', bay_tracking_order_id_in_rating='$bay_tracking_order_id_in_rating', bay_username_buyer_in_rating='$bay_username_buyer_in_rating', bay_rating_for_quality_satisfaction=5, bay_rating_for_communication_satisfaction=5, bay_rating_testimonial='', bay_rating_status='NO', bay_rating_date=''";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_review);
}
}
/*** ***/
public function sales_commission($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
//
$username_buyer_paypal = $_SESSION['ebusername'];
//
if(isset($_SESSION['omrebusername']))
{
$username_saler_sales_comm = $_SESSION['omrebusername'];
}
else
{
$username_saler_sales_comm = 0;
}
//
$queryReferrer = "SELECT omrusername FROM  excessusers WHERE ebusername='$username_saler_sales_comm'";
$queryReferrerResult = eBConDb::eBgetInstance()->eBgetConection()->query($queryReferrer);
$referrerInfo = mysqli_fetch_array($queryReferrerResult);
$username_referrer = isset($referrerInfo['omrusername']);
//
$order_tracking_unique_paypal = $_SESSION['order_tracking_unique_id'];
$bay_id_in_paypal = intval(preg_replace('#[^0-9]#i','',$_POST['item_number_'.$i]));
$bay_product_qtn_paypal = intval(preg_replace('#[^0-9]#i','',$_POST['quantity_'.$i]));
/** VVI Please Check bay_sub_total_price_bk  **/
$bay_sub_total_price_paypal = floatval(number_format($_POST['item_total_price_'.$i],2,'.',''));
$total_sales_commissions = floatval(number_format(($bay_sub_total_price_paypal * 25)/100,2, '.', ''));
$total_commi_level_first = floatval(number_format(($bay_sub_total_price_paypal * 5)/100,2, '.', ''));
$payment_status = "NO";
$payment_date = date("Y-m-d H:i:s");
//
$queryCommiBay = "INSERT INTO bay_product_sales_commissions set username_buyer_sales_comm='$username_buyer_paypal', username_saler_sales_comm='$username_saler_sales_comm', username_referrer='$username_referrer', tracking_unique_sales_comm='$order_tracking_unique_paypal', bay_product_id=$bay_id_in_paypal, bay_product_qtn_sales_comm=$bay_product_qtn_paypal, total_price_per_item=$bay_sub_total_price_paypal, total_commi_self=$total_sales_commissions, total_commi_level_first=$total_commi_level_first, bkash_tranjaction_sales_comm='', payment_status='$payment_status', sales_date='$payment_date', self_payment_status='NO', ref_payment_status='NO', payment_through_paypal_bkash='PayPal', paid_through_paypal_bkash='', ref_paid_through_paypal_bkash='', self_payment_date='', ref_payment_date='', self_tranjaction_id='', ref_tranjaction_id=''";
$resultCommi = eBConDb::eBgetInstance()->eBgetConection()->query($queryCommiBay);
}
}

public function review_crm_bkash($sln)
{
$sln = intval($sln);
for($i=1; $i<=$sln; $i++)
{
$bay_product_id_in_rating = intval($_POST['item_number_'.$i]);
$bay_tracking_order_id_in_rating = $_SESSION['order_tracking_unique_id'];
$bay_username_buyer_in_rating = $_SESSION['ebusername'];
$query_review = "INSERT INTO bay_rating_multiple_items SET bay_product_id_in_rating='$bay_product_id_in_rating', bay_tracking_order_id_in_rating='$bay_tracking_order_id_in_rating', bay_username_buyer_in_rating='$bay_username_buyer_in_rating', bay_rating_for_quality_satisfaction=5, bay_rating_for_communication_satisfaction=5, bay_rating_testimonial='', bay_rating_status='NO', bay_rating_date=''";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query_review);
}
}
/*##################################### CRM Paypal Payment ########################################################*/
public function bay_paypal_payment_gross_crm($param)
{
foreach ($_POST as $key => $value)
:
$value = urlencode(stripslashes($value));
/*** ***/
$username_buyer_pg = $_SESSION["ebusername"];
$tracking_unique_sales_order_pg = $_SESSION["order_tracking_unique_id"];
$txn_id_pg = $param['txn_id'];
$mc_gross_pg = floatval(number_format($param['mc_gross'],2,'.',''));
$mc_currency_pg = $param['mc_currency'];
$payment_status_pg = $param['payment_status'];
$first_name_pg = $param['first_name'];
$last_name_pg = $param['last_name'];
$payer_email_pg = $param['payer_email'];
$payment_date_pg = date("Y-m-d H:i:s");
$payment_fee_pg = floatval(number_format($param['mc_fee'],2,'.',''));
endforeach;
/*** ***/
$query_paypal_payment = "INSERT INTO bay_payment_gross_crm SET username_buyer_pg='$username_buyer_pg', tracking_unique_sales_order_pg='$tracking_unique_sales_order_pg', txn_id_pg='$txn_id_pg', mc_gross_pg=$mc_gross_pg, mc_currency_pg='$mc_currency_pg', payment_status_pg='$payment_status_pg', first_name_pg='$first_name_pg', last_name_pg='$last_name_pg', payer_email_pg='$payer_email_pg', payment_date_pg='$payment_date_pg', payment_fee_pg=$payment_fee_pg";
eBConDb::eBgetInstance()->eBgetConection()->query($query_paypal_payment);
}
/*** ***/
public function bay_paypal_payment_crm()
{
if (floatval(number_format($_POST['mc_gross'],2,'.','')) == number_format($_SESSION['total_payment'],2,'.','') && $_POST['payment_status'] == 'Completed')
{
$this->bay_paypal_payment_gross_crm($_POST);
$payment_status = 'OK';

/* Using Tranjaction */
eBConDb::eBgetInstance()->eBgetConection()->autocommit(false);
$order_tracking_id = $_SESSION['order_tracking_unique_id'];
$username_buyer = $_SESSION['ebusername'];
/* Update Order M2M */
$queryTwo = "UPDATE bay_order_m2m_for_crm SET payment_status='$payment_status' where tracking_unique_sales_order_in_m2m='$order_tracking_id' and username_buyer_in_m2m_for_crm='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryTwo);	
/* Update for Sales Report and Stock Update */
$queryThree = "UPDATE bay_salse_report_stock_update SET payment_status='$payment_status' where tracking_unique_sales_order_sr='$order_tracking_id' and username_buyer_sr='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryThree);
/* Update Order */
$queryFour = "UPDATE bay_items_order_crm SET payment_status='$payment_status' where tracking_unique_sales_order_io='$order_tracking_id' and username_buyer_io='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryFour);
/* Update for Shipment Prove */
$queryFive = "UPDATE bay_shipment_prove_crm SET payment_status='$payment_status' where tracking_unique_sales_order_spg='$order_tracking_id' and username_buyer_spg='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryFive);
/* Update for Return and Refund */
$querySix = "UPDATE bay_returns_refunds_crm SET payment_status='$payment_status' where tracking_unique_sales_order_rrg='$order_tracking_id' and username_buyer_rrg='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($querySix);
/* Update for Support */
$querySeven = "UPDATE bay_buyer_support_multiple_items SET bay_buyer_payment_status='$payment_status' where bay_order_tracking_id='$order_tracking_id' and bay_username_buyer_seller='$username_buyer'";
eBConDb::eBgetInstance()->eBgetConection()->query($querySeven);
/* Update for Ratings */
$queryEight = "UPDATE bay_rating_multiple_items SET bay_rating_status='$payment_status' where bay_tracking_order_id_in_rating='$order_tracking_id' and bay_username_buyer_in_rating='$username_buyer'";
$resultEignt = eBConDb::eBgetInstance()->eBgetConection()->query($queryEight);
	
if(!$resultEignt)
{ 
eBConDb::eBgetInstance()->eBgetConection()->rollback();
echo "<div class='well'><b>Sorry, Something wrong with your transaction.</b></div>";
}
else
{
echo "<div class='well'><b>Your transaction has been completed, Thank you for your purchase.</b></div>";
/**##############**/
$username_buyer = $_SESSION['ebusername'];
$queryNine = "SELECT email FROM excessusers WHERE ebusername='$username_buyer'";
$resultNine = eBConDb::eBgetInstance()->eBgetConection()->query($queryNine);
$resultNineInfo = mysqli_fetch_array($resultNine);
$buyer_email = $resultNineInfo['email'];
/*** ***/
$mailPaypal = new PHPMailer(true);
try
{
//
$mailPaypal->isSMTP();
//$mailPaypal->SMTPDebug = SMTP::DEBUG_SERVER;
$mailPaypal->Host = smtpHost;
$mailPaypal->SMTPAuth   = true;
$mailPaypal->Username   = smtpUsername;
$mailPaypal->Password   = smtpPassword;
/* For port 587 and TLS */
$mailPaypal->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mailPaypal->Port = smtpPort;
//
$mailPaypal->setFrom(adminEmail, domain);
$mailPaypal->addAddress($buyer_email);
$mailPaypal->isHTML(true);
//$mailPaypal->addAttachment('');
$mailPaypal->Subject = "Your PayPal payment confirmation";
//
$message ="<html>";
$message .="<head>";
$message .="<title>We have received your PayPal payment</title>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>Hi $username_buyer, We have received your PayPal payment</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outBayLinkFull."/user-purchase-history.php";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View your purchase history</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
//
$mailPaypal->Body = $message;
//
$mailPaypal->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$mailPaypal->ErrorInfo}";
}
/*** ***/
}
eBConDb::eBgetInstance()->eBgetConection()->commit();
}
}
/*######## bKash Payment No Ok ###########*/
public function bay_approve_bkash_nook($username_buyer_bk, $order_tracking_unique_bk, $bkash_tranjaction_id_bk)
{
$bkash_payment_status = 'NOOK';
/* Using Tranjaction */
eBConDb::eBgetInstance()->eBgetConection()->autocommit(false);
/* Update bKash Pament */
$queryOne = "UPDATE bay_bkash_gross_crm SET bkash_payment_status = '$bkash_payment_status' where username_buyer_bk='$username_buyer_bk' and order_tracking_unique_bk = '$order_tracking_unique_bk' and bkash_tranjaction_id_bk = '$bkash_tranjaction_id_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryOne);
/* Update Order M2M */
$queryTwo = "UPDATE bay_order_m2m_for_crm SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_in_m2m='$order_tracking_unique_bk' and username_buyer_in_m2m_for_crm='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryTwo);	
/* Update for Sales Report and Stock Update */
$queryThree = "UPDATE bay_salse_report_stock_update SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_sr='$order_tracking_unique_bk' and username_buyer_sr='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryThree);
/* Update Order */
$queryFour = "UPDATE bay_items_order_crm SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_io='$order_tracking_unique_bk' and username_buyer_io='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryFour);
/* Update for Shipment Prove */
$queryFive = "UPDATE bay_shipment_prove_crm SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_spg='$order_tracking_unique_bk' and username_buyer_spg='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryFive);
/* Update for Return and Refund */
$querySix = "UPDATE bay_returns_refunds_crm SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_rrg='$order_tracking_unique_bk' and username_buyer_rrg='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($querySix);
/* Update for Support */
$querySeven = "UPDATE bay_buyer_support_multiple_items SET bay_buyer_payment_status='$bkash_payment_status' where bay_order_tracking_id='$order_tracking_unique_bk' and bay_username_buyer_seller='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($querySeven);
/* Update for Ratings */
$queryEight = "UPDATE bay_rating_multiple_items SET bay_rating_status='$bkash_payment_status' where bay_tracking_order_id_in_rating='$order_tracking_unique_bk' and bay_username_buyer_in_rating='$username_buyer_bk'";
$resultEignt = eBConDb::eBgetInstance()->eBgetConection()->query($queryEight);
if(!$resultEignt)
{ 
eBConDb::eBgetInstance()->eBgetConection()->rollback();
}
else
{
echo "<div class='well'><b>Update bKash Payment, Sales, Support and Ratings Done</b></div>";
}
eBConDb::eBgetInstance()->eBgetConection()->commit();
}
/*######## bKash Payment ###########*/
public function bay_approve_bkash_payment($username_buyer_bk, $order_tracking_unique_bk, $bkash_tranjaction_id_bk)
{
$bkash_payment_status = 'OK';
/* Using Tranjaction */
eBConDb::eBgetInstance()->eBgetConection()->autocommit(false);
/* Update bKash Pament */
$queryOne = "UPDATE bay_bkash_gross_crm SET bkash_payment_status = '$bkash_payment_status' where username_buyer_bk='$username_buyer_bk' and order_tracking_unique_bk = '$order_tracking_unique_bk' and bkash_tranjaction_id_bk = '$bkash_tranjaction_id_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryOne);
/* Update Order M2M */
$queryTwo = "UPDATE bay_order_m2m_for_crm SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_in_m2m='$order_tracking_unique_bk' and username_buyer_in_m2m_for_crm='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryTwo);	
/* Update for Sales Report and Stock Update */
$queryThree = "UPDATE bay_salse_report_stock_update SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_sr='$order_tracking_unique_bk' and username_buyer_sr='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryThree);
/* Update Order */
$queryFour = "UPDATE bay_items_order_crm SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_io='$order_tracking_unique_bk' and username_buyer_io='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryFour);
/* Update for Shipment Prove */
$queryFive = "UPDATE bay_shipment_prove_crm SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_spg='$order_tracking_unique_bk' and username_buyer_spg='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($queryFive);
/* Update for Return and Refund */
$querySix = "UPDATE bay_returns_refunds_crm SET payment_status='$bkash_payment_status' where tracking_unique_sales_order_rrg='$order_tracking_unique_bk' and username_buyer_rrg='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($querySix);
/* Update for Support */
$querySeven = "UPDATE bay_buyer_support_multiple_items SET bay_buyer_payment_status='$bkash_payment_status' where bay_order_tracking_id='$order_tracking_unique_bk' and bay_username_buyer_seller='$username_buyer_bk'";
eBConDb::eBgetInstance()->eBgetConection()->query($querySeven);
/* Update for Ratings */
$queryEight = "UPDATE bay_rating_multiple_items SET bay_rating_status='$bkash_payment_status' where bay_tracking_order_id_in_rating='$order_tracking_unique_bk' and bay_username_buyer_in_rating='$username_buyer_bk'";
$resultEignt = eBConDb::eBgetInstance()->eBgetConection()->query($queryEight);

/**##############**/
$queryNine = "SELECT email FROM excessusers WHERE ebusername='$username_buyer_bk'";
$resultNine = eBConDb::eBgetInstance()->eBgetConection()->query($queryNine);
$resultNineInfo = mysqli_fetch_array($resultNine);
$buyer_email = $resultNineInfo['email'];
/*** ***/
$mailBkashCon = new PHPMailer(true);
try
{
//
$mailBkashCon->isSMTP();
//$mailBkashCon->SMTPDebug = SMTP::DEBUG_SERVER;
$mailBkashCon->Host = smtpHost;
$mailBkashCon->SMTPAuth   = true;
$mailBkashCon->Username   = smtpUsername;
$mailBkashCon->Password   = smtpPassword;
/* For port 587 and TLS */
$mailBkashCon->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mailBkashCon->Port = smtpPort;
//
$mailBkashCon->setFrom(adminEmail, domain);
$mailBkashCon->addAddress($buyer_email);
$mailBkashCon->isHTML(true);
//$mailBkashCon->addAttachment('');
$mailBkashCon->Subject = "Your bKash payment confirmation";
//
$message ="<html>";
$message .="<head>";
$message .="<title>We have received your bKash payment</title>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>Hi $username_buyer_bk we have received your bKash payment</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outBayLinkFull."/user-purchase-history.php";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View your purchase history</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
//
$mailBkashCon->Body = $message;
//
$mailBkashCon->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$mailBkashCon->ErrorInfo}";
}
/*** ***/
if(!$resultEignt)
{ 
eBConDb::eBgetInstance()->eBgetConection()->rollback();
}
else
{
echo "<div class='well'><b>Update bKash Payment, Sales, Support and Ratings Done</b></div>";
}
eBConDb::eBgetInstance()->eBgetConection()->commit();
}
/*** ***/
public function bay_bKash_payment_verify_admin_no_ok()
{
$query1 = "SELECT * FROM  bay_bkash_gross_crm WHERE bkash_payment_status='NOOK' ORDER BY payment_bk_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query1);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function bay_bKash_payment_verify_admin()
{
/*OK*/
$query1 = "SELECT * FROM  bay_bkash_gross_crm WHERE bkash_payment_status='NO'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query1);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function bay_bkash_payment_gross_crm($bKashSln)
{
if(isset($_REQUEST['bay_submit_bkash_trxid']))
{
extract($_REQUEST);
$username_buyer_bk = $_SESSION['ebusername'];
$order_tracking_unique_bk = $_SESSION['order_tracking_unique_id'];
$bkash_tranjaction_id_bk = $_POST['bay_bkash_trxid']; 
$bkash_payment_status = "NO";
$payment_date_bk = date("Y-m-d H:i:s");
$grand_total_price_bk = floatval(number_format($_SESSION['total_payment']* convertSecondary,2,'.',''));
//
if(isset($_SESSION['omrebusername']))
{
$username_saler_sales_comm = $_SESSION['omrebusername'];
}
else
{
$username_saler_sales_comm = 0;
}
//
for($i=1; $i<=$bKashSln; $i++)
{
//
$queryReferrer = "SELECT omrusername FROM  excessusers WHERE ebusername='$username_saler_sales_comm'";
$queryReferrerResult = eBConDb::eBgetInstance()->eBgetConection()->query($queryReferrer);
$referrerInfo = mysqli_fetch_array($queryReferrerResult);
$username_referrer = isset($referrerInfo['omrusername']);
//
$bay_id_in_bk = intval(preg_replace('#[^0-9]#i','',$_POST['item_number_'.$i]));
$bay_name_in_bk = preg_replace('#[^a-zA-Z0-9\.\-\_]#i','',$_POST['item_name_'.$i]);
$bay_qtn_in_bk = intval(preg_replace('#[^0-9]#i','',$_POST['quantity_'.$i]));
$vat_of_bay_bk = floatval(number_format($_POST['tax_'.$i] * convertSecondary,2,'.',''));
/** VVI Please Check bay_sub_total_price_bk  **/
$bay_sub_total_price_bk = floatval(number_format($_POST['amount_'.$i] * convertSecondary,2,'.',''));
$handling_bk = floatval(number_format($_POST['handling_'.$i] * convertSecondary,2,'.',''));
$shipment_fee_of_item_bk = floatval(number_format(preg_replace('#[^0-9\.]#i','',$_POST['shipping_'.$i])* convertSecondary,2,'.',''));
//
$total_sales_commissions = floatval(number_format(($bay_sub_total_price_bk * 25)/100,2, '.', ''));
$total_commi_level_first = floatval(number_format(($bay_sub_total_price_bk * 5)/100,2, '.', ''));
//
$query1 = "INSERT INTO bay_bkash_gross_crm set username_buyer_bk='$username_buyer_bk', bay_id_in_bk=$bay_id_in_bk, order_tracking_unique_bk='$order_tracking_unique_bk', bay_name_in_bk='$bay_name_in_bk', bay_qtn_in_bk=$bay_qtn_in_bk, vat_of_bay_bk=$vat_of_bay_bk, bay_sub_total_price_bk=$bay_sub_total_price_bk, shipment_fee_of_item_bk=$shipment_fee_of_item_bk, grand_total_price_bk=$grand_total_price_bk, bkash_tranjaction_id_bk='$bkash_tranjaction_id_bk', bkash_payment_status='$bkash_payment_status', payment_date_bk='$payment_date_bk'";
$result1 = eBConDb::eBgetInstance()->eBgetConection()->query($query1);
//
$queryCommiSoft = "INSERT INTO bay_product_sales_commissions set username_buyer_sales_comm='$username_buyer_bk', username_saler_sales_comm='$username_saler_sales_comm', username_referrer='$username_referrer', tracking_unique_sales_comm='$order_tracking_unique_bk', bay_product_id=$bay_id_in_bk, bay_product_qtn_sales_comm=$bay_qtn_in_bk, total_price_per_item=$bay_sub_total_price_bk, total_commi_self=$total_sales_commissions, total_commi_level_first=$total_commi_level_first, bkash_tranjaction_sales_comm='$bkash_tranjaction_id_bk', payment_status='$bkash_payment_status', sales_date='$payment_date_bk', self_payment_status='NO', ref_payment_status='NO', payment_through_paypal_bkash='bKash', paid_through_paypal_bkash='', ref_paid_through_paypal_bkash='', self_payment_date='', ref_payment_date='', self_tranjaction_id='', ref_tranjaction_id=''";
$resultCommi = eBConDb::eBgetInstance()->eBgetConection()->query($queryCommiSoft);
//
}
}
}

/*** ***/
public function icon_find_products()
{
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND s_discount_percent >=5.00";
$query .=" GROUP BY s_category_c";
$query .=" ORDER BY salse DESC, discount DESC";
$query .=" LIMIT 8";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function menu_sub_sub_category_showroom($catSub,$catSubSub)
{
$query = "SELECT s_category_c, MAX(bay_showroom_approved_items_id) AS bay_showroom_approved_items_id FROM bay_showroom_approved_items where bay_showroom_approved_items.s_product_approved =1 AND bay_showroom_approved_items.s_category_a='$catSub' AND bay_showroom_approved_items.s_category_b='$catSubSub' GROUP BY bay_showroom_approved_items.s_category_c";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function menu_sub_category_showroom($cat)
{
$query = "SELECT s_category_b FROM bay_showroom_approved_items where bay_showroom_approved_items.s_product_approved =1 AND bay_showroom_approved_items.s_category_a='$cat' GROUP BY bay_showroom_approved_items.s_category_b";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function menu_category_showroom()
{
$query = "SELECT s_category_a FROM bay_showroom_approved_items where bay_showroom_approved_items.s_product_approved =1 GROUP BY bay_showroom_approved_items.s_category_a";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_category_d_to_show()
{
/*** MySQL 8.0.23 OK ***/
$query = "SELECT * FROM bay_category_d ORDER BY bay_category_a_in_bay_category_d, bay_category_b_in_bay_category_d, bay_category_c_in_bay_category_d ASC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_category_c_to_show()
{
/*** MySQL 8.0.23 OK ***/
$query = "SELECT * FROM bay_category_c ORDER BY bay_category_a_in_bay_category_c, bay_category_b_in_bay_category_c, bay_category_c ASC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_category_b_to_show()
{
/*** MySQL 8.0.23 OK ***/
$query = "SELECT * FROM bay_category_b ORDER BY bay_category_a_in_bay_category_b, bay_category_b ASC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function eidt_submit_category_d($category_d, $category_d_id)
{
/*** MySQL 8.0.23 OK ***/
$category_d_id = intval($category_d_id);
$updateCategoryA = "UPDATE bay_category_d SET bay_category_d='$category_d' WHERE bay_category_d_id='$category_d_id'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryA);
echo $this->ebDone();
}
/*** ***/
public function eidt_submit_category_c($category_c_new, $category_c_old)
{
/*** MySQL 8.0.23 OK ***/
$category_c_new = strval($category_c_new);
$category_c_old = strval($category_c_old);
$updateCategoryCC = "UPDATE bay_category_c SET bay_category_c='$category_c_new' WHERE bay_category_c='$category_c_old'";
$testresultCC = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryCC);
//
$updateCategoryDD = "UPDATE bay_category_d SET bay_category_c_in_bay_category_d='$category_c_new' WHERE bay_category_c_in_bay_category_d='$category_c_old'";
$testresultDD = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryDD);
echo $this->ebDone();
}
/*** ***/
public function eidt_category_d_to_show()
{
if(isset($_REQUEST['edit_category_d']))
{
extract($_REQUEST);
$category_d_id = strval($_GET['category_d_id']);
$query = "SELECT * FROM bay_category_d WHERE bay_category_d_id='$category_d_id'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function eidt_category_c_to_show()
{
if(isset($_REQUEST['edit_category_c']))
{
extract($_REQUEST);
$category_c_old = strval($_GET['category_c_old']);
$query = "SELECT * FROM bay_category_c WHERE bay_category_c='$category_c_old'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function eidt_category_b_to_show()
{
if(isset($_REQUEST['edit_category_b']))
{
extract($_REQUEST);
$category_b_old = strval($_GET['category_b_old']);
$query = "SELECT * FROM bay_category_b WHERE bay_category_b='$category_b_old'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function eidt_submit_category_b($category_b_new, $category_b_old)
{
/*** MySQL 8.0.23 OK ***/
$category_b_new = strval($category_b_new);
$category_b_old = strval($category_b_old);
$updateCategoryBB = "UPDATE bay_category_b SET bay_category_b='$category_b_new' WHERE bay_category_b='$category_b_old'";
$testresultBB = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryBB);
//
$updateCategoryCC = "UPDATE bay_category_c SET bay_category_b_in_bay_category_c='$category_b_new' WHERE bay_category_b_in_bay_category_c='$category_b_old'";
$testresultCC = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryCC);
//
$updateCategoryDD = "UPDATE bay_category_d SET bay_category_b_in_bay_category_d='$category_b_new' WHERE bay_category_b_in_bay_category_d='$category_b_old'";
$testresultDD = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryDD);
echo $this->ebDone();
}
/*** ***/
public function submit_edit_item_unit($item_unit_id, $item_unit_name)
{
/*** MySQL 8.0.23 OK ***/
$item_unit_id = intval($item_unit_id);
$item_unit_name = strval($item_unit_name);
//
$updateCategoryAA = "UPDATE bay_size_all SET size_name='$item_unit_name' WHERE size_id=$item_unit_id";
$testresultAA = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryAA);
//
echo $this->ebDone();
}
/*** ***/
public function eidt_submit_category_a($category_a_old, $category_a_new)
{
/*** MySQL 8.0.23 OK ***/
$category_a_new = strval($category_a_new);
$category_a_old = strval($category_a_old);
//
$updateCategoryAA = "UPDATE bay_category_a SET bay_category_a='$category_a_new' WHERE bay_category_a='$category_a_old'";
$testresultAA = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryAA);
//
$updateCategoryBB = "UPDATE bay_category_b SET bay_category_a_in_bay_category_b='$category_a_new' WHERE bay_category_a_in_bay_category_b='$category_a_old'";
$testresultBB = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryBB);
//
$updateCategoryCC = "UPDATE bay_category_c SET bay_category_a_in_bay_category_c='$category_a_new' WHERE bay_category_a_in_bay_category_c='$category_a_old'";
$testresultCC = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryCC);
//
$updateCategoryDD = "UPDATE bay_category_d SET bay_category_a_in_bay_category_d='$category_a_new' WHERE bay_category_a_in_bay_category_d='$category_a_old'";
$testresultDD = eBConDb::eBgetInstance()->eBgetConection()->query($updateCategoryDD);
//
echo $this->ebDone();
}
/*** ***/
public function submit_itemUunit($itemUunit)
{
/*** MySQL 8.0.23 OK ***/
$query_test = "SELECT * FROM  bay_size_all where size_name='$itemUunit'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;
if($num_result == 0)
{
$query = "INSERT INTO bay_size_all set size_name='$itemUunit'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
else 
{
/*** ***/
echo $this->ebNotDone();
}
}
/*** ***/
public function submit_category_a($category_a)
{
/*** MySQL 8.0.23 OK ***/
$query_test = "SELECT * FROM  bay_category_a where bay_category_a='$category_a'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;
if($num_result == 0)
{
$query = "INSERT INTO bay_category_a set bay_category_a='$category_a'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
else 
{
/*** ***/
echo $this->ebNotDone();
}
}
/*** ***/
public function eidt_item_unit_to_show()
{
if(isset($_REQUEST['edit_unit_item']))
{
extract($_REQUEST);
$sizeid = intval($_GET['sizeid']);
$query = "SELECT * FROM bay_size_all WHERE size_id=$sizeid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function eidt_category_a_to_show()
{
if(isset($_REQUEST['edit_category_a']))
{
extract($_REQUEST);
$category_a_old = strval($_GET['category_a_old']);
$query = "SELECT * FROM bay_category_a WHERE bay_category_a='$category_a_old'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function select_item_unit_to_show()
{
$query = "SELECT * FROM bay_size_all ORDER BY size_name ASC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_category_a_to_show()
{
$query = "SELECT * FROM bay_category_a ORDER BY bay_category_a ASC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function submit_category_b($category_a, $category_b)
{
$query_test = "SELECT * FROM  bay_category_b where bay_category_b='$category_b' and bay_category_a_in_bay_category_b='$category_a'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;
if($num_result == 0)
{
$query = "INSERT INTO bay_category_b set bay_category_b='$category_b' , bay_category_a_in_bay_category_b='$category_a'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
else
{
/*** ***/
echo $this->ebNotDone();
}
}

/*** ***/
public function submit_category_c($category_a, $category_b, $category_c)
{
$query_test = "SELECT * FROM  bay_category_c where bay_category_c='$category_c' and bay_category_a_in_bay_category_c='$category_a' and bay_category_b_in_bay_category_c='$category_b'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;
if($num_result == 0)
{
$query = "INSERT INTO bay_category_c set bay_category_c='$category_c', bay_category_a_in_bay_category_c='$category_a', bay_category_b_in_bay_category_c='$category_b'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
else
{
/*** ***/
echo $this->ebNotDone();
}
}
/*** ***/
public function submit_category_d($category_a, $category_b, $category_c, $category_d)
{
$query_test = "SELECT * FROM  bay_category_d where bay_category_d='$category_d' and bay_category_a_in_bay_category_d='$category_a' and bay_category_b_in_bay_category_d='$category_b' and bay_category_c_in_bay_category_d='$category_c'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;
if($num_result == 0)
{
$query = "INSERT INTO bay_category_d set bay_category_d='$category_d', bay_category_a_in_bay_category_d='$category_a', bay_category_b_in_bay_category_d='$category_b', bay_category_c_in_bay_category_d='$category_c'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
else 
{
/*** ***/
echo $this->ebNotDone();
}
}

/*** ***/
public function submit_new_merchant_item($m_category_a, $m_category_b, $m_category_c, $m_category_d, $m_og_image_title, $m_og_image_description, $m_showroom_id, $m_size, $m_costprice_price, $m_stock, $m_profit_percent, $m_marked_price, $m_discount_percent, $m_vat_tax, $m_weight, $m_handling_packing, $m_video_link, $m_country_of_origin)
{
function trackingUniqueProductKey()
{
$uniqid = uniqid(mt_rand(), true);
$shah_1 = sha1(salt_1.$uniqid.salt_2.salt_1);
return sha1($shah_1);
}
$tracking_unique_product_adi = trackingUniqueProductKey();
$s_m_size = strval($m_size);
$m_og_image_description_2nd = mysqli_real_escape_string(eBConDb::eBgetInstance()->eBgetConection(),$m_og_image_description);
$m_costprice_price = floatval(number_format($m_costprice_price,2,'.',''));
$m_stock = intval($m_stock);
$m_profit_percent = floatval(number_format($m_profit_percent,0,'.',''));
$m_marked_price = floatval(number_format($m_marked_price,2,'.',''));
$m_discount_percent = floatval(number_format($m_discount_percent,0,'.',''));
$m_vat_tax = floatval(number_format($m_vat_tax,2,'.',''));
$m_weight = floatval(number_format($m_weight,2,'.',''));
$m_handling_packing = floatval(number_format($m_handling_packing,2,'.',''));
$m_country_of_origin = intval($m_country_of_origin);
/*** ***/
$username_merchant_adi = $_SESSION['ebusername'];
$m_product_approved = 0;
$m_date = date("Y-m-d H:i:s");
/////////////
$queryCheck = "SELECT m_category_a FROM bay_merchant_add_items WHERE username_merchant_adi='$username_merchant_adi' AND m_category_a='$m_category_a' AND m_category_b='$m_category_b' AND m_category_c='$m_category_c' AND m_category_d='$m_category_d' AND m_showroom_id='$m_showroom_id' AND m_size='$m_size'";
$resultCheck = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheck);
$nubResult = $resultCheck->num_rows;
if($nubResult ==0)
{
//
$query1 = "INSERT INTO bay_merchant_add_items set username_merchant_adi='$username_merchant_adi', tracking_unique_product_adi='$tracking_unique_product_adi', m_product_approved=$m_product_approved, m_category_a='$m_category_a', m_category_b='$m_category_b', m_category_c='$m_category_c', m_category_d='$m_category_d', m_og_image_url='', m_og_small_image_url='', m_og_image_title='$m_og_image_title', m_og_image_description='$m_og_image_description_2nd', m_showroom_id='$m_showroom_id', m_size='$s_m_size', m_costprice_price=$m_costprice_price, m_stock=$m_stock, m_profit_percent=$m_profit_percent, m_marked_price=$m_marked_price, m_discount_percent=$m_discount_percent, m_vat_tax=$m_vat_tax, m_weight=$m_weight, m_handling_packing=$m_handling_packing, m_country_of_origin=$m_country_of_origin, m_video_link='$m_video_link', m_date='$m_date'";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
$bay_merchant_add_items_id = eBConDb::eBgetInstance()->eBgetConection()->insert_id;
/*** ***/
$query2 = "INSERT INTO bay_showroom_approved_items set username_merchant_ai='$username_merchant_adi', tracking_unique_product_ai='$tracking_unique_product_adi', s_product_approved=$m_product_approved, s_category_a='$m_category_a', s_category_b='$m_category_b', s_category_c='$m_category_c', s_category_d='$m_category_d', s_og_image_url='', s_og_small_image_url='', s_og_image_title='$m_og_image_title', s_og_image_description='$m_og_image_description_2nd', s_showroom_id='$m_showroom_id', s_size='$s_m_size', s_costprice_price=$m_costprice_price, s_stock=$m_stock, s_profit_percent=$m_profit_percent, s_marked_price=$m_marked_price, s_discount_percent=$m_discount_percent, s_vat_tax=$m_vat_tax, s_weight=$m_weight, s_handling_packing=$m_handling_packing, s_country_of_origin=$m_country_of_origin, s_video_link='$m_video_link', s_date='$m_date'";
eBConDb::eBgetInstance()->eBgetConection()->query($query2);
$bay_showroom_approved_items_id =eBConDb::eBgetInstance()->eBgetConection()->insert_id;
/*** ***/
$query3 = "INSERT INTO bay_mer_bay_appro_m2m set bay_mer_id_in_m2m=$bay_merchant_add_items_id, bay_appro_id_in_m2m=$bay_showroom_approved_items_id, tracking_bay_mer_bay_appro='$tracking_unique_product_adi'";
$result3 = eBConDb::eBgetInstance()->eBgetConection()->query($query3);
/* Insert for Stock */
$query4 = "INSERT INTO bay_salse_report_stock_update set username_buyer_sr='', tracking_unique_sales_order_sr='', tracking_unique_product_sr='$tracking_unique_product_adi', bay_showroom_approved_items_id_sr='$bay_showroom_approved_items_id', sqtn_sr=0, item_total_price_sr=0.00, item_total_tax_sr=0.00, size_sr='', sdate_sr='$m_date', username_salse_sr='', username_merchant_sr='$username_merchant_adi', payment_status='OK'";
$result4= eBConDb::eBgetInstance()->eBgetConection()->query($query4);
/*** ***/
if($result4)
{
/*** ***/
echo "<pre><b>Done $m_showroom_id-$m_size</b></pre>";
}
}
else
{
echo "<pre>This product already exist</pre>";
echo $this->ebNotDone();
}
}
/*** ***/
public function merchant_view_items()
{
$username_merchant_adi = $_SESSION['ebusername'];
$query ="SELECT * FROM";
$query .=" bay_merchant_add_items";
$query .=" where bay_merchant_add_items.username_merchant_adi='$username_merchant_adi' AND m_product_approved <=2 ORDER BY bay_merchant_add_items_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function updates_merchant_branding_image_url($branding_id,$m_url)
{
/* Do not use target='_blank', it will not remove the image */
$branding_id = intval($branding_id);
$query = "UPDATE bay_branding_carosoul SET branding_image_url='$m_url' WHERE branding_id=$branding_id";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
if($result)
{
/*** ***/
echo $this->ebDone();
?>
<script>
window.location.replace('bay-branding-status.php');
</script>
<?php
}
}
/*** ***/
public function upload_image_to_bay_branding_merchant()
{
if(isset($_REQUEST['upload_image_branding']))
{
extract($_REQUEST);
$branding_id = intval($_REQUEST['branding_id']);
$query ="SELECT * FROM";
$query .=" bay_branding_carosoul";
$query .=" WHERE branding_id=$branding_id";
$query .=" limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function upload_image_to_bay_merchant()
{
if(isset($_REQUEST['upload_image']))
{
extract($_REQUEST);
$bay_merchant_add_items_id = intval($_REQUEST['bay_merchant_add_items_id']);
$query ="SELECT * FROM";
$query .=" bay_merchant_add_items";
$query .=" where bay_merchant_add_items.bay_merchant_add_items_id=$bay_merchant_add_items_id";
$query .=" limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function updates_bay_small_image_url($bay_merchant_add_items_id,$bay_mer_og_small_image_url)
{
/* Do not use target='_blank', it will not remove the image */
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$query = "update bay_merchant_add_items set m_og_small_image_url='$bay_mer_og_small_image_url' where bay_merchant_add_items_id=$bay_merchant_add_items_id";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
}
/*** ***/
public function updates_merchant_image_url($bay_merchant_add_items_id,$m_url)
{
/* Do not use target='_blank', it will not remove the image */
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$query = "update bay_merchant_add_items set m_og_image_url='$m_url' where bay_merchant_add_items_id=$bay_merchant_add_items_id";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
if($result)
{
/*** ***/
echo $this->ebDone();
?>
<script>
window.location.replace('bay-merchants-items-view.php');
</script>
<?php
}
}
/*** ***/
public function admin_merchant_view_items()
{
$query ="SELECT * FROM";
$query .=" bay_merchant_add_items where bay_merchant_add_items.m_product_approved=0 ORDER BY bay_merchant_add_items.bay_merchant_add_items_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
//
public function branding_item_update($branding_id, $branding_title, $branding_url)
{
$query2 = "UPDATE bay_branding_carosoul SET branding_active=0, branding_title='$branding_title', branding_url='$branding_url' WHERE branding_id=$branding_id";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2);
if($result2nd)
{ 
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function edit_branding_item()
{
if(isset($_GET['branding_id'])){$branding_id = intval($_GET['branding_id']);}
$query ="SELECT * FROM bay_branding_carosoul";
$query .=" WHERE branding_id=$branding_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function deleteBranding($branding_id, $branding_image_url) 
{
$branding_id = intval($branding_id);
$branding_image_url = str_replace(hostingName, docRoot, hypertext.$branding_image_url);
if(!empty($branding_image_url))
{
unlink($branding_image_url);
}
$query2nd = "DELETE FROM bay_branding_carosoul WHERE branding_id=$branding_id";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2nd);
if($result2nd)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function notBayBrandingApproved($branding_id, $branding_image_url) 
{
$branding_id = intval($branding_id);
$branding_image_url = str_replace(hostingName, docRoot, hypertext.$branding_image_url);
if(!empty($branding_image_url))
{
unlink($branding_image_url);
}
$query2nd = "UPDATE bay_branding_carosoul SET branding_active=0, branding_image_url='' WHERE branding_id=$branding_id";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2nd);
if($result2nd)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function approve_merchants_branding_items($branding_id)
{
$branding_id = intval($branding_id);
$branding_active =1;
/*** ***/
$queryBranding = "UPDATE bay_branding_carosoul SET branding_active=$branding_active WHERE branding_id=$branding_id";
$resultBranding = eBConDb::eBgetInstance()->eBgetConection()->query($queryBranding);
if($resultBranding)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function approve_merchants_items($bay_merchant_add_items_id, $m_og_image_url, $m_og_small_image_url, $m_og_image_title, $m_showroom_id, $m_size, $m_marked_price, $m_stock, $m_discount_percent, $m_vat_tax, $m_weight, $m_handling_packing)
{
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$m_product_approved =1;
$m_marked_price = floatval(number_format($m_marked_price,2,'.',''));
$m_stock = intval($m_stock);
$m_discount_percent = floatval(number_format($m_discount_percent,2,'.',''));
$m_vat_tax = floatval(number_format($m_vat_tax,2,'.',''));
$m_weight = floatval(number_format($m_weight,2,'.',''));
$m_handling_packing = floatval(number_format($m_handling_packing,2,'.',''));
/*** ***/
$query1 = "update bay_merchant_add_items SET m_product_approved=$m_product_approved where bay_merchant_add_items_id=$bay_merchant_add_items_id";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
/*** ***/
$query2 = "UPDATE bay_showroom_approved_items SET s_product_approved=$m_product_approved, s_og_image_url='$m_og_image_url', s_og_small_image_url='$m_og_small_image_url', s_og_image_title='$m_og_image_title', s_showroom_id='$m_showroom_id', s_size='$m_size', s_marked_price=$m_marked_price, s_stock=$m_stock, s_discount_percent=$m_discount_percent, s_vat_tax=$m_vat_tax, s_weight=$m_weight, s_handling_packing=$m_handling_packing WHERE bay_showroom_approved_items_id=$bay_merchant_add_items_id";
$resultApproved = eBConDb::eBgetInstance()->eBgetConection()->query($query2);
if($resultApproved)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function notProductApproved($bay_merchant_add_items_id, $m_og_image_url) 
{
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$m_og_image_url = str_replace(hostingName, docRoot, hypertext.$m_og_image_url);
if(!empty($m_og_image_url))
{
unlink($m_og_image_url);
}
$query1st = "UPDATE bay_merchant_add_items SET m_product_approved=0, m_og_image_url='' WHERE bay_merchant_add_items_id=$bay_merchant_add_items_id";
eBConDb::eBgetInstance()->eBgetConection()->query($query1st);
$query2nd = "UPDATE bay_showroom_approved_items SET s_product_approved=0, s_og_image_url='' WHERE bay_showroom_approved_items_id=$bay_merchant_add_items_id";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2nd);
if($result2nd)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function reject_merchants_items($bay_merchant_add_items_id, $m_og_image_url, $m_og_small_image_url)
{
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$m_og_image_url = str_replace(hostingName, docRoot, hypertext.$m_og_image_url);
if(!empty($m_og_image_url))
{
unlink($m_og_image_url); 
}
$m_og_small_image_url = str_replace(hostingName, docRoot, hypertext.$m_og_small_image_url);
if(!empty($m_og_small_image_url))
{
unlink($m_og_small_image_url); 
}
$query1st = "UPDATE bay_merchant_add_items SET m_product_approved=3, m_og_image_url='', m_og_small_image_url='' WHERE bay_merchant_add_items_id=$bay_merchant_add_items_id";
eBConDb::eBgetInstance()->eBgetConection()->query($query1st);
/*** ***/
$query2nd = "UPDATE bay_showroom_approved_items SET s_product_approved=3, s_og_image_url='', s_og_small_image_url='' WHERE bay_showroom_approved_items_id=$bay_merchant_add_items_id";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2nd);
if($result2nd)
{
/*** ***/
echo $this->ebDone();
}
}
public function delete_merchants_items_multi_image($bay_merchant_add_items_id)
{
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$queryCheck = "SELECT * FROM bay_merchant_multi_img WHERE add_items_id_in_bay_merchant_multi_img=$bay_merchant_add_items_id";
$resultCheck = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheck);
$numResultCheck = $resultCheck->num_rows;
if($numResultCheck)
{
$queryTwo = "SELECT * FROM bay_merchant_multi_img WHERE add_items_id_in_bay_merchant_multi_img=$bay_merchant_add_items_id";
$resultTwo = eBConDb::eBgetInstance()->eBgetConection()->query($queryTwo);
$numResultTwo = $resultTwo->num_rows;
if($numResultTwo)
{
for($i=1; $i<=$numResultTwo; $i++)
{
$resultTwoInfo = mysqli_fetch_array($resultTwo);
$multiImageURL = $resultTwoInfo['bay_big_imag_url'];
$multiImagePath = str_replace(hostingName, docRoot, hypertext.$multiImageURL);
if(!empty($multiImagePath))
{
unlink($multiImagePath);
}
}
}
//
}
}
/*** ***/
public function edit_product_item()
{
$bay_merchant_add_items_id = intval($_GET['bay_merchant_add_items_id']);
$username_merchant_adi = $_GET['username_merchant_adi'];
$query ="SELECT * FROM bay_merchant_add_items";
$query .=" WHERE bay_merchant_add_items_id=$bay_merchant_add_items_id AND username_merchant_adi='$username_merchant_adi'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
}
//
public function merchant_product_update_as_new($m_category_a, $m_category_b, $m_category_c, $m_category_d, $bay_merchant_add_items_id, $uniqueProductID, $m_og_image_title, $m_og_image_description, $m_showroom_id, $m_size, $m_costprice_price, $m_stock, $m_profit_percent, $m_marked_price, $m_discount_percent, $m_vat_tax, $m_weight, $m_handling_packing, $m_video_link)
{
$m_category_a = strval($m_category_a);
$m_category_b = strval($m_category_b);
$m_category_c = strval($m_category_c);
$m_category_d = strval($m_category_d);
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$uniqueProductID = strval($uniqueProductID);
$m_og_image_title = strval($m_og_image_title);
$m_og_image_description_2nd = mysqli_real_escape_string(eBConDb::eBgetInstance()->eBgetConection(),$m_og_image_description);
$m_showroom_id = strval($m_showroom_id);
$m_size = strval($m_size);
//
$m_costprice_price = floatval(number_format($m_costprice_price,2,'.',''));
$m_stock = intval(number_format($m_stock,2,'.',''));
//
$m_profit_percent = floatval(number_format($m_profit_percent,2,'.',''));
//
$m_marked_price = floatval(number_format($m_marked_price,2,'.',''));
//
$m_discount_percent = floatval(number_format($m_discount_percent,2,'.',''));
$m_vat_tax = floatval(number_format($m_vat_tax,2,'.',''));
$m_weight = floatval(number_format($m_weight,2,'.',''));
$m_handling_packing = floatval(number_format($m_handling_packing,2,'.',''));
$m_video_link = strval($m_video_link);
$query1 = "UPDATE bay_merchant_add_items SET m_product_approved=0, m_category_a='$m_category_a', m_category_b='$m_category_b', m_category_c='$m_category_c', m_category_d='$m_category_d', m_og_image_title='$m_og_image_title', m_og_image_description='$m_og_image_description_2nd', m_showroom_id='$m_showroom_id', m_size='$m_size', m_costprice_price=$m_costprice_price, m_stock=$m_stock, m_profit_percent=$m_profit_percent, m_discount_percent=$m_discount_percent, m_marked_price=$m_marked_price, m_vat_tax=$m_vat_tax, m_weight=$m_weight, m_handling_packing=$m_handling_packing, m_video_link='$m_video_link' WHERE bay_merchant_add_items_id=$bay_merchant_add_items_id AND tracking_unique_product_adi='$uniqueProductID'";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
/*** ***/
$query2 = "UPDATE bay_showroom_approved_items SET s_product_approved=0, s_category_a='$m_category_a', s_category_b='$m_category_b', s_category_c='$m_category_c', s_category_d='$m_category_d', s_og_image_title='$m_og_image_title', s_og_image_description='$m_og_image_description_2nd', s_showroom_id='$m_showroom_id', s_size='$m_size', s_costprice_price=$m_costprice_price, s_stock=$m_stock, s_profit_percent=$m_profit_percent, s_discount_percent=$m_discount_percent, s_marked_price=$m_marked_price, s_vat_tax=$m_vat_tax, s_weight=$m_weight, s_handling_packing=$m_handling_packing, s_video_link='$m_video_link' WHERE bay_showroom_approved_items_id='$bay_merchant_add_items_id' AND tracking_unique_product_ai='$uniqueProductID'";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2);
if($result2nd)
{ 
/*** ***/
echo $this->ebDone();
}
}
//
public function merchant_product_update($m_category_a, $m_category_b, $m_category_c, $m_category_d, $bay_merchant_add_items_id, $uniqueProductID, $m_og_image_title, $m_og_image_description, $m_showroom_id, $m_size, $m_stock, $m_profit_percent, $m_discount_percent, $m_vat_tax, $m_weight, $m_handling_packing, $m_video_link)
{
$m_category_a = strval($m_category_a);
$m_category_b = strval($m_category_b);
$m_category_c = strval($m_category_c);
$m_category_d = strval($m_category_d);
$bay_merchant_add_items_id = intval($bay_merchant_add_items_id);
$uniqueProductID = strval($uniqueProductID);
$m_og_image_title = strval($m_og_image_title);
$m_og_image_description_2nd = mysqli_real_escape_string(eBConDb::eBgetInstance()->eBgetConection(),$m_og_image_description);
$m_showroom_id = strval($m_showroom_id);
$m_size = strval($m_size);
$m_stock = intval(number_format($m_stock,2,'.',''));
$m_profit_percent = floatval(number_format($m_profit_percent,2,'.',''));
$m_discount_percent = floatval(number_format($m_discount_percent,2,'.',''));
$m_vat_tax = floatval(number_format($m_vat_tax,2,'.',''));
$m_weight = floatval(number_format($m_weight,2,'.',''));
$m_handling_packing = floatval(number_format($m_handling_packing,2,'.',''));
$m_video_link = strval($m_video_link);
$query1 = "UPDATE bay_merchant_add_items SET m_product_approved=0, m_category_a='$m_category_a', m_category_b='$m_category_b', m_category_c='$m_category_c', m_category_d='$m_category_d', m_og_image_title='$m_og_image_title', m_og_image_description='$m_og_image_description_2nd', m_showroom_id='$m_showroom_id', m_size='$m_size', m_stock=$m_stock, m_profit_percent=$m_profit_percent, m_discount_percent=$m_discount_percent, m_vat_tax=$m_vat_tax, m_weight=$m_weight, m_handling_packing=$m_handling_packing, m_video_link='$m_video_link' WHERE bay_merchant_add_items_id=$bay_merchant_add_items_id AND tracking_unique_product_adi='$uniqueProductID'";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
/*** ***/
$query2 = "UPDATE bay_showroom_approved_items SET s_product_approved=0, s_category_a='$m_category_a', s_category_b='$m_category_b', s_category_c='$m_category_c', s_category_d='$m_category_d', s_og_image_title='$m_og_image_title', s_og_image_description='$m_og_image_description_2nd', s_showroom_id='$m_showroom_id', s_size='$m_size', s_stock=$m_stock, s_profit_percent=$m_profit_percent, s_discount_percent=$m_discount_percent, s_vat_tax=$m_vat_tax, s_weight=$m_weight, s_handling_packing=$m_handling_packing, s_video_link='$m_video_link' WHERE bay_showroom_approved_items_id='$bay_merchant_add_items_id' AND tracking_unique_product_ai='$uniqueProductID'";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2);
if($result2nd)
{ 
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function search_in_bay()
{
if(isset($_REQUEST['search_bay']))
{
extract($_REQUEST);
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" MAX(bay_showroom_approved_items_id) AS maxid,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_og_image_title";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" AND s_og_image_title LIKE '%".$_REQUEST['search_bay']."%'";
$query .=" AND s_category_a IN (SELECT s_category_a FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_a)";
$query .=" AND s_category_b IN (SELECT s_category_b FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_b)";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_d)";
$query .=" AND s_showroom_id IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_showroom_id)";
$query .=" GROUP BY";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_og_image_title";
$query .=" ORDER BY s_og_image_title";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function search_in_bay_one($maxid)
{
$maxid = intval($maxid);
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.tracking_unique_product_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" s.salse,";
$query .=" (showroom.purchase - s.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_size,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.username_merchant_ai,";
$query .=" bay_showroom_approved_items.tracking_unique_product_ai,";
$query .=" bay_showroom_approved_items.s_category_a,";
$query .=" bay_showroom_approved_items.s_category_b,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id,";
$query .=" bay_showroom_approved_items.s_og_image_url,";
$query .=" bay_showroom_approved_items.s_og_small_image_url,";
$query .=" bay_showroom_approved_items.s_og_image_title,";
$query .=" bay_showroom_approved_items.s_og_image_description,";
$query .=" SUM(bay_showroom_approved_items.s_stock) AS purchase,";
$query .=" bay_showroom_approved_items.s_marked_price AS showroomprice,";
$query .=" bay_showroom_approved_items.s_marked_price * bay_showroom_approved_items.s_discount_percent / 100 AS discount,";
$query .=" bay_showroom_approved_items.s_size,";
$query .=" bay_showroom_approved_items.s_marked_price,";
$query .=" bay_showroom_approved_items.s_discount_percent,";
$query .=" bay_showroom_approved_items.s_vat_tax,";
$query .=" bay_showroom_approved_items.s_weight,";
$query .=" bay_showroom_approved_items.s_handling_packing,";
$query .=" bay_showroom_approved_items.s_country_of_origin,";
$query .=" bay_showroom_approved_items.s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" bay_showroom_approved_items.s_product_approved = 1";
$query .=" AND s_category_a IN (SELECT s_category_a FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_a)";
$query .=" AND s_category_b IN (SELECT s_category_b FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_b)";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_d)";
$query .=" AND s_showroom_id IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_showroom_id)";
//
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.s_category_a,";
$query .=" bay_showroom_approved_items.s_category_b,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id";
$query .=" ) showroom";
$query .=" JOIN(";
$query .=" SELECT";
$query .=" bay_salse_report_stock_update.tracking_unique_product_sr,";
$query .=" SUM(bay_salse_report_stock_update.sqtn_sr) AS salse,";
$query .=" bay_salse_report_stock_update.payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" bay_salse_report_stock_update.payment_status = 'OK'";
$query .=" GROUP BY bay_salse_report_stock_update.tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" showroom.bay_showroom_approved_items_id=$maxid";
$query .=" ORDER BY discount DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_category_a_edit()
{
$query ="SELECT * FROM";
$query .=" bay_category_a";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_category_a()
{
$query ="SELECT * FROM";
$query .=" bay_category_a";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;

if($num_result)
{
while($rows=$result->fetch_array())
{
echo "<option value='".$rows['bay_category_a']."'>".$this->visulString($rows['bay_category_a'])."</option>"; 
}
}
$result -> free_result();
}
/*** ***/
public function select_category_b()
{
$query ="SELECT * FROM";
$query .=" bay_category_b group by bay_category_b";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
echo "<option value='".$rows['bay_category_b']."'>".$rows['bay_category_b']."</option>"; 
}
}
$result -> free_result();
}
/*** ***/
public function select_category_c()
{
$query ="SELECT * FROM";
$query .=" bay_category_c group by bay_category_c";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
echo "<option value='".$rows['bay_category_c']."'>".$rows['bay_category_c']."</option>"; 
}
}
$result -> free_result();
}
/*** ***/
public function select_category_d()
{
$query ="SELECT * FROM";
$query .=" bay_category_d group by bay_category_d";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
echo "<option value='".$rows['bay_category_d']."'>".$rows['bay_category_d']."</option>"; 
}
}
$result -> free_result();
}
/*** ***/
public function read_merchant_items_to_edit()
{
if(isset($_REQUEST['read_merchants_items']))
{
extract($_REQUEST);
$bay_merchant_add_items_id = intval($_REQUEST['bay_merchant_add_items_id']);
$query ="SELECT * FROM";
$query .=" bay_merchant_add_items";
$query .=" where bay_merchant_add_items.bay_merchant_add_items_id=$bay_merchant_add_items_id";
$query .=" limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function updates_merchant_item($bay_merchant_add_items_id,$username_m,$m_product_approved,$m_category_a,$m_category_b,$m_category_c,$m_category_d,$m_og_image_url,$m_og_image_title,$m_og_image_description,$m_showroom_id,$m_size,$m_marked_price,$m_stock,$m_discount_percent)
{
$m_product_approved = floatval(number_format($m_product_approved,2,'.',''));
$m_marked_price = floatval(number_format($m_marked_price,2,'.',''));
$m_stock = intval($m_stock);
$m_discount_percent = floatval(number_format($m_discount_percent,2,'.',''));
/*** ***/
$query = "update bay_merchant_add_items set username_m='$username_m', m_product_approved=$m_product_approved, m_category_a='$m_category_a', m_category_b='$m_category_b', m_category_c='$m_category_c', m_category_d='$m_category_d', m_og_image_url='$m_og_image_url', m_og_image_title='$m_og_image_title', m_og_image_description='$m_og_image_description', m_showroom_id='$m_showroom_id', m_size='$m_size', m_marked_price=$m_marked_price, m_stock=$m_stock, m_discount_percent=$m_discount_percent where bay_merchant_add_items_id=$bay_merchant_add_items_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
/*** ***/
echo $this->ebDone();
}
}

/*** ***/
public function hotdeals()
{
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" sout.salse >= 0";
$query .=" ORDER BY sout.salse DESC";
$query .=" LIMIT 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function selected_new_arrival_desc_carousel($eBCategoryCC, $eBCategoryDD)
{
$query = "SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 AND s_category_c LIKE '%$eBCategoryCC%' AND s_category_d LIKE '%$eBCategoryDD%' GROUP BY username_merchant_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_showroom_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$query .=" LIMIT 8";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function branding_carousel()
{
/*** MySQL 8.0.23 OK ***/
$query = "SELECT * FROM bay_branding_carosoul";
$query .=" WHERE branding_active=1";
$query .=" ORDER BY branding_id DESC";
$query .=" LIMIT 8";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function new_arrival_desc_carousel_abcdid()
{
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" MAX(bay_showroom_approved_items_id) AS maxid,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" GROUP BY";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d";
$query .=" ORDER BY maxid DESC";
$query .=" LIMIT 3";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function new_arrival_desc_carousel($maxid)
{
$maxid = intval($maxid);
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" sout.salse >= 0";
$query .=" AND showroom.bay_showroom_approved_items_id=$maxid";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$query .=" LIMIT 8";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function mrss_bay()
{
$query = "SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
//
public function item_thurmnai_category_seller($username_merchant)
{
/*** MySQL 8.0.23 OK ***/
$seller ="SELECT";
$seller .=" showroom.bay_showroom_approved_items_id,";
$seller .=" showroom.username_merchant_ai,";
$seller .=" showroom.s_category_a,";
$seller .=" showroom.s_category_b,";
$seller .=" showroom.s_category_c,";
$seller .=" showroom.s_category_d,";
$seller .=" showroom.s_showroom_id,";
$seller .=" showroom.s_size,";
$seller .=" showroom.s_og_image_url,";
$seller .=" showroom.s_og_small_image_url,";
$seller .=" showroom.s_og_image_title,";
$seller .=" showroom.s_og_image_description,";
$seller .=" sout.salse,";
$seller .=" (showroom.purchase - sout.salse) AS stockinhand,";
$seller .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$seller .=" showroom.s_marked_price,";
$seller .=" showroom.s_discount_percent,";
$seller .=" showroom.s_vat_tax,";
$seller .=" showroom.s_weight,";
$seller .=" showroom.s_handling_packing,";
$seller .=" showroom.s_country_of_origin,";
$seller .=" showroom.s_date";
$seller .=" FROM";
$seller .=" (";
$seller .=" SELECT";
$seller .=" bay_showroom_approved_items_id,";
$seller .=" username_merchant_ai,";
$seller .=" tracking_unique_product_ai,";
$seller .=" s_category_a,";
$seller .=" s_category_b,";
$seller .=" s_category_c,";
$seller .=" s_category_d,";
$seller .=" s_showroom_id,";
$seller .=" s_size,";
$seller .=" s_og_image_url,";
$seller .=" s_og_small_image_url,";
$seller .=" s_og_image_title,";
$seller .=" s_og_image_description,";
$seller .=" SUM(s_stock) AS purchase,";
$seller .=" s_marked_price AS showroomprice,";
$seller .=" s_marked_price * s_discount_percent / 100 AS discount,";
$seller .=" s_marked_price,";
$seller .=" s_discount_percent,";
$seller .=" s_vat_tax,";
$seller .=" s_weight,";
$seller .=" s_handling_packing,";
$seller .=" s_country_of_origin,";
$seller .=" s_date";
$seller .=" FROM bay_showroom_approved_items";
$seller .=" WHERE";
$seller .=" s_product_approved = 1";
$seller .=" AND username_merchant_ai='$username_merchant'";
$seller .=" GROUP BY";
$seller .=" bay_showroom_approved_items_id,";
$seller .=" s_category_a,";
$seller .=" s_category_b,";
$seller .=" s_category_c,";
$seller .=" s_category_d,";
$seller .=" s_showroom_id,";
$seller .=" s_size";
$seller .=" ) showroom";
$seller .=" JOIN";
$seller .=" (";
$seller .=" SELECT";
$seller .=" tracking_unique_product_sr,";
$seller .=" SUM(sqtn_sr) AS salse,";
$seller .=" payment_status";
$seller .=" FROM bay_salse_report_stock_update";
$seller .=" WHERE";
$seller .=" payment_status = 'OK'";
$seller .=" GROUP BY tracking_unique_product_sr";
$seller .=" ) sout";
$seller .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$seller .=" ORDER BY bay_showroom_approved_items_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($seller);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** PAGINATION MAX DISCOUNT **/
public function bayProductPaginationMaxDis()
{
/*** MySQL 8.0.23 OK ***/
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 12; 
$startpoint = ($page * $per_page) - $per_page;
$url='?';
//
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" sout.salse >= 0";
$query .=" ORDER BY discount ASC";
//
$resultNum = eBConDb::eBgetInstance()->eBgetConection()->query($query);
//
if($resultNum)
{
$total = $resultNum->num_rows;
$adjacents = "2"; 
$prevlabel = "&lsaquo; Prev";
$nextlabel = "Next &rsaquo;";
$lastlabel = "Last &rsaquo;&rsaquo;";
$page = ($page == 0 ? 1 : $page);  
$start = ($page - 1) * $per_page;
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total/$per_page);
$lpm1 = $lastpage - 1;
$pagination = "<div class='pager'>";
$pagination .= "<div class='pages'>";
if($lastpage > 1)
{   
$pagination .= "<ul class='pagination'>";
if ($page > 1)
$pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
if ($lastpage < 7 + ($adjacents * 2)){   
for ($counter = 1; $counter <= $lastpage; $counter++){
if ($counter == $page)
$pagination.= "<li class='active'><a>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
} elseif($lastpage > 1 + ($adjacents * 2)){

if($page < 1 + ($adjacents * 2))
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>...</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>...</li>";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>..</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
} else {
$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>..</li>";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
}
}
if ($page < $counter - 1) {
$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
}
$pagination.= "</ul>";
}
$pagination.= "</div>";
$pagination.= "</div>";
return $pagination;
}
$resultNum -> free_result();
}
//
public function maxDiscountABCDID()
{
/*** MySQL 8.0.23 OK ***/
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 12; 
$startpoint = ($page * $per_page) - $per_page;
//
$statement ="SELECT";
$statement .=" showroom.bay_showroom_approved_items_id,";
$statement .=" showroom.username_merchant_ai,";
$statement .=" showroom.s_category_a,";
$statement .=" showroom.s_category_b,";
$statement .=" showroom.s_category_c,";
$statement .=" showroom.s_category_d,";
$statement .=" showroom.s_showroom_id,";
$statement .=" showroom.s_size,";
$statement .=" showroom.s_og_image_url,";
$statement .=" showroom.s_og_small_image_url,";
$statement .=" showroom.s_og_image_title,";
$statement .=" showroom.s_og_image_description,";
$statement .=" sout.salse,";
$statement .=" (showroom.purchase - sout.salse) AS stockinhand,";
$statement .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$statement .=" showroom.s_marked_price,";
$statement .=" showroom.s_discount_percent,";
$statement .=" showroom.s_vat_tax,";
$statement .=" showroom.s_weight,";
$statement .=" showroom.s_handling_packing,";
$statement .=" showroom.s_country_of_origin,";
$statement .=" showroom.s_date";
$statement .=" FROM";
$statement .=" (";
$statement .=" SELECT";
$statement .=" bay_showroom_approved_items_id,";
$statement .=" username_merchant_ai,";
$statement .=" tracking_unique_product_ai,";
$statement .=" s_category_a,";
$statement .=" s_category_b,";
$statement .=" s_category_c,";
$statement .=" s_category_d,";
$statement .=" s_showroom_id,";
$statement .=" s_size,";
$statement .=" s_og_image_url,";
$statement .=" s_og_small_image_url,";
$statement .=" s_og_image_title,";
$statement .=" s_og_image_description,";
$statement .=" SUM(s_stock) AS purchase,";
$statement .=" s_marked_price AS showroomprice,";
$statement .=" s_marked_price * s_discount_percent / 100 AS discount,";
$statement .=" s_marked_price,";
$statement .=" s_discount_percent,";
$statement .=" s_vat_tax,";
$statement .=" s_weight,";
$statement .=" s_handling_packing,";
$statement .=" s_country_of_origin,";
$statement .=" s_date";
$statement .=" FROM bay_showroom_approved_items";
$statement .=" WHERE";
$statement .=" s_product_approved = 1";
$statement .=" GROUP BY";
$statement .=" bay_showroom_approved_items_id,";
$statement .=" s_category_a,";
$statement .=" s_category_b,";
$statement .=" s_category_c,";
$statement .=" s_category_d,";
$statement .=" s_showroom_id,";
$statement .=" s_size";
$statement .=" ) showroom";
$statement .=" JOIN";
$statement .=" (";
$statement .=" SELECT";
$statement .=" tracking_unique_product_sr,";
$statement .=" SUM(sqtn_sr) AS salse,";
$statement .=" payment_status";
$statement .=" FROM bay_salse_report_stock_update";
$statement .=" WHERE";
$statement .=" payment_status = 'OK'";
$statement .=" GROUP BY tracking_unique_product_sr";
$statement .=" ) sout";
$statement .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$statement .=" WHERE";
$statement .=" sout.salse >= 0";
$statement .=" ORDER BY discount ASC";
$query = "$statement LIMIT {$startpoint}, {$per_page}";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** PAGINATION BEST SALES **/
public function  bayProductPaginationBestSales()
{
/*** MySQL 8.0.23 OK ***/
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 12; 
$startpoint = ($page * $per_page) - $per_page;
$url='?';
//
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" sout.salse >= 1";
$query .=" ORDER BY sout.salse DESC";
//
$resultNum = eBConDb::eBgetInstance()->eBgetConection()->query($query);
//
if($resultNum)
{
$total = $resultNum->num_rows;
$adjacents = "2"; 
$prevlabel = "&lsaquo; Prev";
$nextlabel = "Next &rsaquo;";
$lastlabel = "Last &rsaquo;&rsaquo;";
$page = ($page == 0 ? 1 : $page);  
$start = ($page - 1) * $per_page;
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total/$per_page);
$lpm1 = $lastpage - 1;
$pagination = "<div class='pager'>";
$pagination .= "<div class='pages'>";
if($lastpage > 1)
{   
$pagination .= "<ul class='pagination'>";
if ($page > 1)
$pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
if ($lastpage < 7 + ($adjacents * 2)){   
for ($counter = 1; $counter <= $lastpage; $counter++){
if ($counter == $page)
$pagination.= "<li class='active'><a>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
} elseif($lastpage > 1 + ($adjacents * 2)){

if($page < 1 + ($adjacents * 2))
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>...</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>...</li>";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>..</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
} else {
$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>..</li>";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
}
}
if ($page < $counter - 1) {
$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
}
$pagination.= "</ul>";
}
$pagination.= "</div>";
$pagination.= "</div>";
return $pagination;
}
$resultNum -> free_result();
}
/*** ***/
public function bestSales()
{
/*** MySQL 8.0.23 OK ***/
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 12; 
$startpoint = ($page * $per_page) - $per_page;
//
$statement ="SELECT";
$statement .=" showroom.bay_showroom_approved_items_id,";
$statement .=" showroom.username_merchant_ai,";
$statement .=" showroom.s_category_a,";
$statement .=" showroom.s_category_b,";
$statement .=" showroom.s_category_c,";
$statement .=" showroom.s_category_d,";
$statement .=" showroom.s_showroom_id,";
$statement .=" showroom.s_size,";
$statement .=" showroom.s_og_image_url,";
$statement .=" showroom.s_og_small_image_url,";
$statement .=" showroom.s_og_image_title,";
$statement .=" showroom.s_og_image_description,";
$statement .=" sout.salse,";
$statement .=" (showroom.purchase - sout.salse) AS stockinhand,";
$statement .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$statement .=" showroom.s_marked_price,";
$statement .=" showroom.s_discount_percent,";
$statement .=" showroom.s_vat_tax,";
$statement .=" showroom.s_weight,";
$statement .=" showroom.s_handling_packing,";
$statement .=" showroom.s_country_of_origin,";
$statement .=" showroom.s_date";
$statement .=" FROM";
$statement .=" (";
$statement .=" SELECT";
$statement .=" bay_showroom_approved_items_id,";
$statement .=" username_merchant_ai,";
$statement .=" tracking_unique_product_ai,";
$statement .=" s_category_a,";
$statement .=" s_category_b,";
$statement .=" s_category_c,";
$statement .=" s_category_d,";
$statement .=" s_showroom_id,";
$statement .=" s_size,";
$statement .=" s_og_image_url,";
$statement .=" s_og_small_image_url,";
$statement .=" s_og_image_title,";
$statement .=" s_og_image_description,";
$statement .=" SUM(s_stock) AS purchase,";
$statement .=" s_marked_price AS showroomprice,";
$statement .=" s_marked_price * s_discount_percent / 100 AS discount,";
$statement .=" s_marked_price,";
$statement .=" s_discount_percent,";
$statement .=" s_vat_tax,";
$statement .=" s_weight,";
$statement .=" s_handling_packing,";
$statement .=" s_country_of_origin,";
$statement .=" s_date";
$statement .=" FROM bay_showroom_approved_items";
$statement .=" WHERE";
$statement .=" s_product_approved = 1";
$statement .=" GROUP BY";
$statement .=" bay_showroom_approved_items_id,";
$statement .=" s_category_a,";
$statement .=" s_category_b,";
$statement .=" s_category_c,";
$statement .=" s_category_d,";
$statement .=" s_showroom_id,";
$statement .=" s_size";
$statement .=" ) showroom";
$statement .=" JOIN";
$statement .=" (";
$statement .=" SELECT";
$statement .=" tracking_unique_product_sr,";
$statement .=" SUM(sqtn_sr) AS salse,";
$statement .=" payment_status";
$statement .=" FROM bay_salse_report_stock_update";
$statement .=" WHERE";
$statement .=" payment_status = 'OK'";
$statement .=" GROUP BY tracking_unique_product_sr";
$statement .=" ) sout";
$statement .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$statement .=" WHERE";
$statement .=" sout.salse >= 1";
$statement .=" ORDER BY sout.salse DESC";
$query = "$statement LIMIT {$startpoint}, {$per_page}";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/** PAGINATION GROUP **/
public function bayProductPaginationGroup()
{
/*** MySQL 8.0.23 OK ***/
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 12; 
$startpoint = ($page * $per_page) - $per_page;
$url='?';
//
$query ="SELECT";
$query .=" MAX(bay_showroom_approved_items_id) AS maxid,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" GROUP BY";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d";
$query .=" ORDER BY MAX(bay_showroom_approved_items_id) DESC";
//
$resultNum = eBConDb::eBgetInstance()->eBgetConection()->query($query);
//
if($resultNum)
{
$total = $resultNum->num_rows;
$adjacents = "2"; 
$prevlabel = "&lsaquo; Prev";
$nextlabel = "Next &rsaquo;";
$lastlabel = "Last &rsaquo;&rsaquo;";
$page = ($page == 0 ? 1 : $page);  
$start = ($page - 1) * $per_page;
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total/$per_page);
$lpm1 = $lastpage - 1;
$pagination = "<div class='pager'>";
$pagination .= "<div class='pages'>";
if($lastpage > 1)
{   
$pagination .= "<ul class='pagination'>";
if ($page > 1)
$pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
if ($lastpage < 7 + ($adjacents * 2)){   
for ($counter = 1; $counter <= $lastpage; $counter++){
if ($counter == $page)
$pagination.= "<li class='active'><a>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
} elseif($lastpage > 1 + ($adjacents * 2)){

if($page < 1 + ($adjacents * 2))
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>...</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>...</li>";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>..</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
} else {
$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>..</li>";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
}
}
if ($page < $counter - 1) {
$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
}
$pagination.= "</ul>";
}
$pagination.= "</div>";
$pagination.= "</div>";
return $pagination;
}
$resultNum -> free_result();
}
/** PAGINATION GROUP **/
public function bayProductAllGroupByABCDID()
{
/*** MySQL 8.0.23 OK ***/
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 12; 
$startpoint = ($page * $per_page) - $per_page;
//
$statement ="SELECT";
$statement .=" MAX(bay_showroom_approved_items_id) AS maxid,";
$statement .=" s_category_a,";
$statement .=" s_category_b,";
$statement .=" s_category_c,";
$statement .=" s_category_d";
$statement .=" FROM bay_showroom_approved_items";
$statement .=" WHERE";
$statement .=" s_product_approved = 1";
$statement .=" GROUP BY";
$statement .=" s_category_a,";
$statement .=" s_category_b,";
$statement .=" s_category_c,";
$statement .=" s_category_d";
$statement .=" ORDER BY MAX(bay_showroom_approved_items_id) DESC";
$query = "$statement LIMIT {$startpoint}, {$per_page}";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
//
public function bayProductOne($maxid)
{
$maxid = intval($maxid);
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" sout.salse >= 0";
$query .=" AND showroom.bay_showroom_approved_items_id=$maxid";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
//
public function bayProductAllCDonSelection($eBCategoryCC, $eBCategoryDD)
{
if(isset($_REQUEST['selectionSearch']))
{
/*** MySQL 8.0.23 OK ***/
extract($_REQUEST);
$MinPrice = intval($_POST['price-min']); 
$MaxPrice = intval($_POST['price-max']);
$disCount = intval($_POST['discount-max']);
//
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c ='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_d ='$eBCategoryDD' GROUP BY s_category_d)";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE showroomprice >= $MinPrice AND showroomprice <= $MaxPrice AND s_discount_percent <= $disCount";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
//
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
}
else
{
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.tracking_unique_product_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" s.salse,";
$query .=" (showroom.purchase - s.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_size,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.username_merchant_ai,";
$query .=" bay_showroom_approved_items.tracking_unique_product_ai,";
$query .=" bay_showroom_approved_items.s_category_a,";
$query .=" bay_showroom_approved_items.s_category_b,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id,";
$query .=" bay_showroom_approved_items.s_og_image_url,";
$query .=" bay_showroom_approved_items.s_og_image_title,";
$query .=" bay_showroom_approved_items.s_og_image_description,";
$query .=" SUM(bay_showroom_approved_items.s_stock) AS purchase,";
$query .=" bay_showroom_approved_items.s_marked_price AS showroomprice,";
$query .=" bay_showroom_approved_items.s_marked_price * bay_showroom_approved_items.s_discount_percent / 100 AS discount,";
$query .=" bay_showroom_approved_items.s_size,";
$query .=" bay_showroom_approved_items.s_marked_price,";
$query .=" bay_showroom_approved_items.s_discount_percent,";
$query .=" bay_showroom_approved_items.s_vat_tax,";
$query .=" bay_showroom_approved_items.s_weight,";
$query .=" bay_showroom_approved_items.s_handling_packing,";
$query .=" bay_showroom_approved_items.s_country_of_origin,";
$query .=" bay_showroom_approved_items.s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" bay_showroom_approved_items.s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c ='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_d ='$eBCategoryDD' GROUP BY s_category_d)";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id";
$query .=" ) showroom";
$query .=" JOIN(";
$query .=" SELECT";
$query .=" bay_salse_report_stock_update.tracking_unique_product_sr,";
$query .=" SUM(bay_salse_report_stock_update.sqtn_sr) AS salse,";
$query .=" bay_salse_report_stock_update.payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" bay_salse_report_stock_update.payment_status = 'OK'";
$query .=" GROUP BY bay_salse_report_stock_update.tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
$query .=" WHERE showroomprice <= 8000 AND s_discount_percent <= 50";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
}
$result -> free_result();
}
//
public function bayProductAllCDunlimit($eBCategoryCC, $eBCategoryDD)
{
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c ='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_d ='$eBCategoryDD' GROUP BY s_category_d)";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
//
public function bayProductAllCD($eBCategoryCC, $eBCategoryDD)
{
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c ='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_d ='$eBCategoryDD' GROUP BY s_category_d)";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$query .=" LIMIT 8";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
//
public function bay_select_size($username_merchant_ai, $s_category_a, $s_category_b, $s_category_c, $s_category_d, $s_showroom_id)
{
$queSize = "SELECT bay_showroom_approved_items_id, s_size FROM bay_showroom_approved_items WHERE s_product_approved = 1 AND username_merchant_ai='$username_merchant_ai' AND s_category_a ='$s_category_a' AND s_category_b ='$s_category_b' AND s_category_c ='$s_category_c' AND s_category_d ='$s_category_d' AND s_showroom_id ='$s_showroom_id'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($queSize);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_size_merchant_eidt()
{
$query ="select * from bay_size_all";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_size_merchant()
{
$query ="select * from bay_size_all";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
while($rows = $result->fetch_array())
{
echo "<option value='".$rows['size_name']."'>".$this->visulString($rows['size_name'])."</option>"; 
}
$result -> free_result();
}
/* Find all Products */
public function find_products()
{
$query ="SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_og_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" salse,";
$query .=" (purchase - salse) AS stockinhand,";
$query .=" (showroomprice - discount) AS discountprice,";
$query .=" s_size,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_og_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent/100 AS discount,";
$query .=" s_size,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM";
$query .=" bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" GROUP BY bay_showroom_approved_items_id";
$query .=" )";
$query .=" showroom";
$query .=" JOIN(";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM";
$query .=" bay_salse_report_stock_update";
$query .=" WHERE payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" )";
$query .=" s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
$query .=" WHERE salse >= 0";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function item_details_all_you_need($productid)
{
$productid = intval($productid);
$query = "SELECT * FROM bay_showroom_approved_items WHERE s_product_approved =1 AND bay_showroom_approved_items_id=$productid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
return $row;
}
}
$result -> free_result();
}

/*** ***/
public function item_details_preview_on($productid)
{
$query ="SELECT * from bay_merchant_multi_img WHERE add_items_id_in_bay_merchant_multi_img=$productid AND bay_image_approved=1 LIMIT 6";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function itemPageInnation($productid)
{
/*** MySQL 8.0.23 OK ***/
$productid = intval($productid);
$query ="SELECT * FROM bay_showroom_approved_items";  
$query .=" WHERE s_product_approved =1 AND bay_showroom_approved_items_id = $productid"; 
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function item_last_item_seo()
{
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_video_link, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_video_link, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$query .=" LIMIT 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function item_details($productid)
{
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.tracking_unique_product_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" s.salse,";
$query .=" (showroom.purchase - s.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_size,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.username_merchant_ai,";
$query .=" bay_showroom_approved_items.tracking_unique_product_ai,";
$query .=" bay_showroom_approved_items.s_category_a,";
$query .=" bay_showroom_approved_items.s_category_b,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id,";
$query .=" bay_showroom_approved_items.s_og_image_url,";
$query .=" bay_showroom_approved_items.s_og_image_title,";
$query .=" bay_showroom_approved_items.s_og_image_description,";
$query .=" SUM(bay_showroom_approved_items.s_stock) AS purchase,";
$query .=" bay_showroom_approved_items.s_marked_price AS showroomprice,";
$query .=" bay_showroom_approved_items.s_marked_price * bay_showroom_approved_items.s_discount_percent / 100 AS discount,";
$query .=" bay_showroom_approved_items.s_size,";
$query .=" bay_showroom_approved_items.s_marked_price,";
$query .=" bay_showroom_approved_items.s_discount_percent,";
$query .=" bay_showroom_approved_items.s_vat_tax,";
$query .=" bay_showroom_approved_items.s_weight,";
$query .=" bay_showroom_approved_items.s_handling_packing,";
$query .=" bay_showroom_approved_items.s_country_of_origin,";
$query .=" bay_showroom_approved_items.s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" bay_showroom_approved_items.s_product_approved = 1";
$query .=" AND s_category_a IN (SELECT s_category_a FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_a)";
$query .=" AND s_category_b IN (SELECT s_category_b FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_b)";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_d)";
$query .=" AND s_showroom_id IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_showroom_id)";
//
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.s_category_a,";
$query .=" bay_showroom_approved_items.s_category_b,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id";
$query .=" ) showroom";
$query .=" JOIN(";
$query .=" SELECT";
$query .=" bay_salse_report_stock_update.tracking_unique_product_sr,";
$query .=" SUM(bay_salse_report_stock_update.sqtn_sr) AS salse,";
$query .=" bay_salse_report_stock_update.payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" bay_salse_report_stock_update.payment_status = 'OK'";
$query .=" GROUP BY bay_salse_report_stock_update.tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" bay_showroom_approved_items_id = $productid";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function item_thurmnai_category_c_prev($productid, $sHowRoomID, $eBCategoryCC, $eBCategoryDD)
{
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.tracking_unique_product_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" s.salse,";
$query .=" (showroom.purchase - s.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_size,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.username_merchant_ai,";
$query .=" bay_showroom_approved_items.tracking_unique_product_ai,";
$query .=" bay_showroom_approved_items.s_category_a,";
$query .=" bay_showroom_approved_items.s_category_b,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id,";
$query .=" bay_showroom_approved_items.s_og_image_url,";
$query .=" bay_showroom_approved_items.s_og_image_title,";
$query .=" bay_showroom_approved_items.s_og_image_description,";
$query .=" SUM(bay_showroom_approved_items.s_stock) AS purchase,";
$query .=" bay_showroom_approved_items.s_marked_price AS showroomprice,";
$query .=" bay_showroom_approved_items.s_marked_price * bay_showroom_approved_items.s_discount_percent / 100 AS discount,";
$query .=" bay_showroom_approved_items.s_size,";
$query .=" bay_showroom_approved_items.s_marked_price,";
$query .=" bay_showroom_approved_items.s_discount_percent,";
$query .=" bay_showroom_approved_items.s_vat_tax,";
$query .=" bay_showroom_approved_items.s_weight,";
$query .=" bay_showroom_approved_items.s_handling_packing,";
$query .=" bay_showroom_approved_items.s_country_of_origin,";
$query .=" bay_showroom_approved_items.s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" bay_showroom_approved_items_id < $productid AND bay_showroom_approved_items.s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_d='$eBCategoryDD' GROUP BY s_category_d)";
$query .=" AND s_showroom_id NOT IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_showroom_id='$sHowRoomID' GROUP BY s_showroom_id)";
//
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id";
$query .=" ) showroom";
$query .=" JOIN(";
$query .=" SELECT";
$query .=" bay_salse_report_stock_update.tracking_unique_product_sr,";
$query .=" SUM(bay_salse_report_stock_update.sqtn_sr) AS salse,";
$query .=" bay_salse_report_stock_update.payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" bay_salse_report_stock_update.payment_status = 'OK'";
$query .=" GROUP BY bay_salse_report_stock_update.tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
$query .=" WHERE bay_showroom_approved_items_id != $productid";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$query .=" LIMIT 1";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result ==1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function item_thurmnai_category_c_next($productid, $sHowRoomID, $eBCategoryCC, $eBCategoryDD)
{
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.tracking_unique_product_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" s.salse,";
$query .=" (showroom.purchase - s.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_size,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.username_merchant_ai,";
$query .=" bay_showroom_approved_items.tracking_unique_product_ai,";
$query .=" bay_showroom_approved_items.s_category_a,";
$query .=" bay_showroom_approved_items.s_category_b,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id,";
$query .=" bay_showroom_approved_items.s_og_image_url,";
$query .=" bay_showroom_approved_items.s_og_image_title,";
$query .=" bay_showroom_approved_items.s_og_image_description,";
$query .=" SUM(bay_showroom_approved_items.s_stock) AS purchase,";
$query .=" bay_showroom_approved_items.s_marked_price AS showroomprice,";
$query .=" bay_showroom_approved_items.s_marked_price * bay_showroom_approved_items.s_discount_percent / 100 AS discount,";
$query .=" bay_showroom_approved_items.s_size,";
$query .=" bay_showroom_approved_items.s_marked_price,";
$query .=" bay_showroom_approved_items.s_discount_percent,";
$query .=" bay_showroom_approved_items.s_vat_tax,";
$query .=" bay_showroom_approved_items.s_weight,";
$query .=" bay_showroom_approved_items.s_handling_packing,";
$query .=" bay_showroom_approved_items.s_country_of_origin,";
$query .=" bay_showroom_approved_items.s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" bay_showroom_approved_items_id > $productid AND bay_showroom_approved_items.s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_d='$eBCategoryDD' GROUP BY s_category_d)";
$query .=" AND s_showroom_id NOT IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_showroom_id='$sHowRoomID' GROUP BY s_showroom_id)";
//
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items.bay_showroom_approved_items_id,";
$query .=" bay_showroom_approved_items.s_category_c,";
$query .=" bay_showroom_approved_items.s_category_d,";
$query .=" bay_showroom_approved_items.s_showroom_id";
$query .=" ) showroom";
$query .=" JOIN(";
$query .=" SELECT";
$query .=" bay_salse_report_stock_update.tracking_unique_product_sr,";
$query .=" SUM(bay_salse_report_stock_update.sqtn_sr) AS salse,";
$query .=" bay_salse_report_stock_update.payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" bay_salse_report_stock_update.payment_status = 'OK'";
$query .=" GROUP BY bay_salse_report_stock_update.tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
$query .=" WHERE bay_showroom_approved_items_id != $productid";
$query .=" ORDER BY bay_showroom_approved_items_id DESC";
$query .=" LIMIT 1";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function item_thurmnai_category_c_New($productid, $sHowRoomID, $eBCategoryCC, $eBCategoryDD)
{
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c ='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_d ='$eBCategoryDD' GROUP BY s_category_d)";
$query .=" AND s_showroom_id NOT IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_showroom_id ='$sHowRoomID' GROUP BY s_showroom_id)";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" sout.salse = 0";
$query .=" AND showroom.bay_showroom_approved_items_id != $productid";
$query .=" ORDER BY salse DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function item_thurmnai_category_c($productid, $sHowRoomID, $eBCategoryCC, $eBCategoryDD)
{
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c ='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_d ='$eBCategoryDD' GROUP BY s_category_d)";
$query .=" AND s_showroom_id NOT IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_showroom_id ='$sHowRoomID' GROUP BY s_showroom_id)";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" sout.salse >= 1";
$query .=" AND showroom.bay_showroom_approved_items_id != $productid";
$query .=" ORDER BY salse DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function item_thurmnai_category_b_100($productid, $sHowRoomID, $eBCategoryBB, $eBCategoryCC)
{
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_c ='$eBCategoryCC' GROUP BY s_category_c)";
$query .=" AND s_category_b IN (SELECT s_category_b FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_category_b ='$eBCategoryBB' GROUP BY s_category_b)";
$query .=" AND s_showroom_id NOT IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 AND s_showroom_id ='$sHowRoomID' GROUP BY s_showroom_id)";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" showroom.bay_showroom_approved_items_id != $productid";
$query .=" ORDER BY salse DESC";
$query .=" LIMIT 100";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/* shipment exist!! */
public function shipment_exist()
{
$username = $_SESSION["ebusername"];
$tracking_unique_sales_order_sa = $_SESSION['order_tracking_unique_id'];
$query = "SELECT * FROM";
$query .=" bay_shipping_address_crm";
$query .=" where username_buyer_sa='$username' and tracking_unique_sales_order_sa='$tracking_unique_sales_order_sa'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/* confirm_order_exist!! */
public function confirm_order_exist()
{
$username = $_SESSION["ebusername"];
$tracking_unique_sales_order_sales_order_io = $_SESSION['order_tracking_unique_id'];
$query ="SELECT * FROM";
$query .=" bay_items_order_crm";
$query .=" where username_buyer_io='$username' and tracking_unique_sales_order_io='$tracking_unique_sales_order_sales_order_io'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
//##################################################### eCart ########################################################//
/* Unique GROSS-ORDER Traking Key Generator*/
public function order_tracking_unique_key()
{
$uniqid = uniqid(mt_rand(), true);
$shah_1 = sha1(salt_1.$uniqid.salt_2.salt_1);
return sha1($shah_1);
}
/*** ***/
public function bay_curl()
{
$c = curl_init();
curl_setopt($c, CURLOPT_URL, "https://ebangali.com/out/soft/licensekey.php");
curl_setopt($c, CURLOPT_TIMEOUT, 30);
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
$postfileds = 'server='.domain.'&license='.license;
curl_setopt($c, CURLOPT_POSTFIELDS, $postfileds);
$result = curl_exec($c);
if($result == "fail")
{
/*Fake License Do Nothing*/
}	
}
/*** ***/
public function ecart(){
$this->ecart_bay();
}
/*** ***/
public function defaultsetings()
{	
if(empty($_SESSION['cart']))
{
$_SESSION['cart'] = array();
$_SESSION['total_items'] = intval(0);
$_SESSION['total_price'] = 0.00;
/*** ***/
$_SESSION['total_tax'] = 0.00;
$_SESSION['total_handling'] = 0.00;
$_SESSION['total_shipment'] = 0.00;
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];
}
if(empty($_SESSION['shipping_zone'])){$_SESSION['shipping_zone'] = $this->return_value_admin_dhl_shipping_zone_id_for_cart();}
if(empty($_SESSION['shipping_country_id'])){$_SESSION['shipping_country_id'] = $this->return_value_admin_dhl_shipping_country_id_for_cart();}
/*** ***/
}
/* Cart */
private function ecart_bay()
{
$this -> defaultsetings();
/* controling cart */
$view = empty($_GET['view']) ? 'index' : $_GET['view'];
$controller = 'shop';
/* switch to which view */
switch ($view){
/* switch to index */
case "index":
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPage']))
{
$id = intval($_POST['id']);
$qtnPage = intval($_POST['qtnPage']);
$this->addPage($id, $qtnPage);
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPageMore']))
{
$id = intval($_POST['id']);
$qtnPageMore = intval($_POST['qtnPageMore']);
$this->addPageCheckout($id, $qtnPageMore);
}
//
$_SESSION['total_items'] = $this->total_items($_SESSION['cart']);
$_SESSION['total_price'] = $this ->total_price($_SESSION['cart']);
$_SESSION['total_tax'] = $this ->total_tax($_SESSION['cart']);
$_SESSION['total_handling'] = $this ->total_handling($_SESSION['cart']);
//
$_SESSION['order_tracking_unique_id'] = $this->order_tracking_unique_key();
$_SESSION['shipping_to'] = $this -> shippingto($_SESSION['shipping_zone']);
//
$_SESSION['total_shipment'] = $this ->total_shipment($_SESSION['cart']);
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];
/*** ***/
break;
/* switch to grid */
case "item-details-grid":
if(isset($_GET['id']))
{
$productid = intval($_GET['id']);
$productDetails = $this->item_details_all_you_need($productid);
$eBCategoryAA = $productDetails['s_category_a'];
$eBCategoryBB = $productDetails['s_category_b'];
$eBCategoryCC = $productDetails['s_category_c'];
$eBCategoryDD = $productDetails['s_category_d'];
$sHowRoomID = $productDetails['s_showroom_id']; 
$username_merchant = $productDetails['username_merchant_ai'];
}
//Add to Wishlist
if (isset($_POST['idWish']) and isset($_POST['addWish']))
{
$idWish = intval($_POST['idWish']);
$this->addWish($idWish);
}
//Add to Cart
if (isset($_POST['id']) and isset($_POST['qtnMore']))
{
$id = intval($_POST['id']);
$qtnMore = intval($_POST['qtnMore']);
$this->add($id, $qtnMore);
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPage']))
{
$id = intval($_POST['id']);
$qtnPage = intval($_POST['qtnPage']);
$this->addPage($id, $qtnPage);
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPageMore']))
{
$id = intval($_POST['id']);
$qtnPageMore = intval($_POST['qtnPageMore']);
$this->addPageCheckout($id, $qtnPageMore);
}
//
$_SESSION['total_items'] = $this->total_items($_SESSION['cart']);
$_SESSION['total_price'] = $this ->total_price($_SESSION['cart']);
$_SESSION['total_tax'] = $this ->total_tax($_SESSION['cart']);
$_SESSION['total_handling'] = $this ->total_handling($_SESSION['cart']);
//
$_SESSION['order_tracking_unique_id'] = $this->order_tracking_unique_key();
$_SESSION['shipping_to'] = $this -> shippingto($_SESSION['shipping_zone']);
//
$_SESSION['total_shipment'] = $this ->total_shipment($_SESSION['cart']);
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];

$this->bay_curl();
break;
/* switch to grid */
case "grid":
if(isset($_GET['id']))
{
$productid = intval($_GET['id']);
$productDetails = $this->item_details_all_you_need($productid);
$eBCategoryAA = $productDetails['s_category_a'];
$eBCategoryBB = $productDetails['s_category_b'];
$eBCategoryCC = $productDetails['s_category_c'];
$eBCategoryDD = $productDetails['s_category_d'];
$sHowRoomID = $productDetails['s_showroom_id'];
$username_merchant = $productDetails['username_merchant_ai'];
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPage']))
{
$id = intval($_POST['id']);
$qtnPage = intval($_POST['qtnPage']);
$this->addPage($id, $qtnPage);
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPageMore']))
{
$id = intval($_POST['id']);
$qtnPageMore = intval($_POST['qtnPageMore']);
$this->addPageCheckout($id, $qtnPageMore);
}
//
$_SESSION['total_items'] = $this->total_items($_SESSION['cart']);
$_SESSION['total_price'] = $this ->total_price($_SESSION['cart']);
$_SESSION['total_tax'] = $this ->total_tax($_SESSION['cart']);
$_SESSION['total_handling'] = $this ->total_handling($_SESSION['cart']);
//
$_SESSION['order_tracking_unique_id'] = $this->order_tracking_unique_key();
$_SESSION['shipping_to'] = $this -> shippingto($_SESSION['shipping_zone']);
//
$_SESSION['total_shipment'] = $this ->total_shipment($_SESSION['cart']);
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];
break;
//
case "list":
if(isset($_GET['id']))
{
$productid = intval($_GET['id']);
$productDetails = $this->item_details_all_you_need($productid);
$eBCategoryAA = $productDetails['s_category_a'];
$eBCategoryBB = $productDetails['s_category_b'];
$eBCategoryCC = $productDetails['s_category_c'];
$eBCategoryDD = $productDetails['s_category_d'];
$sHowRoomID = $productDetails['s_showroom_id'];
$username_merchant = $productDetails['username_merchant_ai'];
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPage']))
{
$id = intval($_POST['id']);
$qtnPage = intval($_POST['qtnPage']);
$this->addPage($id, $qtnPage);
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPageMore']))
{
$id = intval($_POST['id']);
$qtnPageMore = intval($_POST['qtnPageMore']);
$this->addPageCheckout($id, $qtnPageMore);
}
//
$_SESSION['total_items'] = $this->total_items($_SESSION['cart']);
$_SESSION['total_price'] = $this ->total_price($_SESSION['cart']);
$_SESSION['total_tax'] = $this ->total_tax($_SESSION['cart']);
$_SESSION['total_handling'] = $this ->total_handling($_SESSION['cart']);
//
$_SESSION['order_tracking_unique_id'] = $this->order_tracking_unique_key();
$_SESSION['shipping_to'] = $this -> shippingto($_SESSION['shipping_zone']);
//
$_SESSION['total_shipment'] = $this ->total_shipment($_SESSION['cart']);
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];
break;
//
case "selectionlist":
if(isset($_GET['id']))
{
$productid = intval($_GET['id']);
$productDetails = $this->item_details_all_you_need($productid);
$eBCategoryAA = $productDetails['s_category_a'];
$eBCategoryBB = $productDetails['s_category_b'];
$eBCategoryCC = $productDetails['s_category_c'];
$eBCategoryDD = $productDetails['s_category_d'];
$sHowRoomID = $productDetails['s_showroom_id'];
$username_merchant = $productDetails['username_merchant_ai'];
}
//
case "selectiongrid":
if(isset($_GET['id']))
{
$productid = intval($_GET['id']);
$productDetails = $this->item_details_all_you_need($productid);
$eBCategoryAA = $productDetails['s_category_a'];
$eBCategoryBB = $productDetails['s_category_b'];
$eBCategoryCC = $productDetails['s_category_c'];
$eBCategoryDD = $productDetails['s_category_d'];
$sHowRoomID = $productDetails['s_showroom_id'];
$username_merchant = $productDetails['username_merchant_ai'];
}
case "item-details-list":
if(isset($_GET['id']))
{
$productid = intval($_GET['id']);
$productDetails = $this->item_details_all_you_need($productid);
$eBCategoryAA = $productDetails['s_category_a'];
$eBCategoryBB = $productDetails['s_category_b'];
$eBCategoryCC = $productDetails['s_category_c'];
$eBCategoryDD = $productDetails['s_category_d'];
$sHowRoomID = $productDetails['s_showroom_id'];
$username_merchant = $productDetails['username_merchant_ai'];
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPage']))
{
$id = intval($_POST['id']);
$qtnPage = intval($_POST['qtnPage']);
$this->addPage($id, $qtnPage);
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPageMore']))
{
$id = intval($_POST['id']);
$qtnPageMore = intval($_POST['qtnPageMore']);
$this->addPageCheckout($id, $qtnPageMore);
}
//
$_SESSION['total_items'] = $this->total_items($_SESSION['cart']);
$_SESSION['total_price'] = $this ->total_price($_SESSION['cart']);
$_SESSION['total_tax'] = $this ->total_tax($_SESSION['cart']);
$_SESSION['total_handling'] = $this ->total_handling($_SESSION['cart']);
//
$_SESSION['order_tracking_unique_id'] = $this->order_tracking_unique_key();
$_SESSION['shipping_to'] = $this -> shippingto($_SESSION['shipping_zone']);
//
$_SESSION['total_shipment'] = $this ->total_shipment($_SESSION['cart']);
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];
break;
/* switch to seller */
case "seller":
if(isset($_GET['id']))
{
$productid = intval($_GET['id']);
$productDetails = $this->item_details_all_you_need($productid);
$eBCategoryAA = $productDetails['s_category_a'];
$eBCategoryBB = $productDetails['s_category_b'];
$eBCategoryCC = $productDetails['s_category_c'];
$eBCategoryDD = $productDetails['s_category_d'];
$sHowRoomID = $productDetails['s_showroom_id']; 
$username_merchant = $productDetails['username_merchant_ai'];
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPage']))
{
$id = intval($_POST['id']);
$qtnPage = intval($_POST['qtnPage']);
$this->addPage($id, $qtnPage);
}
//Add to Cart Page
if (isset($_POST['id']) and isset($_POST['qtnPageMore']))
{
$id = intval($_POST['id']);
$qtnPageMore = intval($_POST['qtnPageMore']);
$this->addPageCheckout($id, $qtnPageMore);
}
//
$_SESSION['total_items'] = $this->total_items($_SESSION['cart']);
$_SESSION['total_price'] = $this ->total_price($_SESSION['cart']);
$_SESSION['total_tax'] = $this ->total_tax($_SESSION['cart']);
$_SESSION['total_handling'] = $this ->total_handling($_SESSION['cart']);
//
$_SESSION['order_tracking_unique_id'] = $this->order_tracking_unique_key();
$_SESSION['shipping_to'] = $this -> shippingto($_SESSION['shipping_zone']);
//
$_SESSION['total_shipment'] = $this ->total_shipment($_SESSION['cart']);
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];
break;
/* switch to checkout */
case "checkout":
//Add to Cart
if (isset($_POST['id']) and isset($_POST['qtnMore']))
{
$id = intval($_POST['id']);
$qtnMore = intval($_POST['qtnMore']);
$this->addCheckout($id, $qtnMore);
}
//
$_SESSION['total_items'] = $this->total_items($_SESSION['cart']);
$_SESSION['total_price'] = $this ->total_price($_SESSION['cart']);
$_SESSION['total_tax'] = $this ->total_tax($_SESSION['cart']);
$_SESSION['total_handling'] = $this ->total_handling($_SESSION['cart']);
//
$_SESSION['order_tracking_unique_id'] = $this->order_tracking_unique_key();
$_SESSION['shipping_to'] = $this -> shippingto($_SESSION['shipping_zone']);
//
$_SESSION['total_shipment'] = $this ->total_shipment($_SESSION['cart']);
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];
/*** ***/
if(empty($_SESSION['shipping_zone'])){$_SESSION['shipping_zone'] = $this->return_value_admin_dhl_shipping_zone_id_for_cart();}
if(empty($_SESSION['shipping_country_id'])){$_SESSION['shipping_country_id'] = $this->return_value_admin_dhl_shipping_country_id_for_cart();}
//
break;
/* switch to checkout-process */
case "checkout-process":
$handling = 0.00;
if(isset($_POST["ContinueCheckout"])){
$this->submit_new_order($_POST['sln']);
$this->bay_order_m2m_crm($_POST['sln']);
$this->submit_new_order_auto_stock_update($_POST['sln']);
$this->shipment_prove_gross_crm($_POST['sln']);
$this->returns_refunds_crm($_POST['sln']);
$this->support_crm($_POST['sln']);
$this->review_crm($_POST['sln']);
$this->sales_commission($_POST['sln']);
}
if(isset($_POST["ContinuebSimplifyCheckout"])){
$this->submit_new_order_simplify($_POST['sln']);
$this->bay_order_m2m_crm_simplify($_POST['sln']);
$this->submit_new_order_auto_stock_update_simplify($_POST['sln']);
$this->shipment_prove_gross_crm_simplify($_POST['sln']);
$this->returns_refunds_crm_simplify($_POST['sln']);
$this->support_crm_simplify($_POST['sln']);
$this->review_crm_simplify($_POST['sln']);
$this->sales_commission_simplify($_POST['sln']);
}
if(isset($_POST["ContinuebKashCheckout"])){
$this->submit_new_order_bkash($_POST['sln']);
$this->bay_order_m2m_crm_bkash($_POST['sln']);
$this->submit_new_order_auto_stock_update_bkash($_POST['sln']);
$this->shipment_prove_gross_crm_bkash($_POST['sln']);
$this->returns_refunds_crm_bkash($_POST['sln']);
$this->support_crm_bkash($_POST['sln']);
$this->review_crm_bkash($_POST['sln']);
}
break;
/* switch to thankyou */
case "thankyou":
$_SESSION['cart'] = array();
$_SESSION['total_items'] = intval(0);
$_SESSION['total_price'] = 0.00;
$_SESSION['total_payment'] = 0.00;
/*** ***/
break;
}
include (ebproduct.'/views/layouts/'.$controller.'.php');
}
/* add to cart page  */
public function addPage($id, $qtnPage)
{
$id = intval($id);
$qtnPage = intval($qtnPage);
if(isset($_SESSION['cart'][$id]))
{
$_SESSION['cart'][$id]+=$qtnPage;
}
else
{
$_SESSION['cart'][$id] = $qtnPage;
}
}
/* add to cart  */
public function add($id, $qtnMore)
{
$id = intval($id);
$qtnMore = intval($qtnMore);
$item_max_qtn_by_stockinhand = $this->item_max_qtn_to_add_from_stockinhand($id);
if(isset($_SESSION['cart'][$id]))
{
if($item_max_qtn_by_stockinhand > $qtnMore)
{
$_SESSION['cart'][$id]+=$qtnMore;
}
else
{
unset($_SESSION['cart'][$id]);
}
}
else
{
$_SESSION['cart'][$id] = $qtnMore;
}
}
/* checkout cart page*/
public function addPageCheckout($id, $qtnPageMore)
{
$id = intval($id);
$qtnPageMore = intval($qtnPageMore);
$item_max_qtn_by_stockinhand = $this->item_max_qtn_to_add_from_stockinhand($id);
if($qtnPageMore == 0)
{
unset($_SESSION['cart'][$id]);
}
elseif(isset($_REQUEST['increasePageItem']))
{
if($item_max_qtn_by_stockinhand > $qtnPageMore)
{
$_SESSION['cart'][$id] ++;
}
else
{
unset($_SESSION['cart'][$id]);
}
}
elseif(isset($_REQUEST['reducedPageItem']))
{
if($qtnPageMore <= 1)
{
unset($_SESSION['cart'][$id]);
}
else
{
$_SESSION['cart'][$id] --;
}
}
else
{
$_SESSION['cart'][$id] = $qtnPageMore;
}
}
/* checkout cart  */
public function addCheckout($id, $qtnMore)
{
//
$id = intval($id);
$qtnMore = intval($qtnMore);
$item_max_qtn_by_stockinhand = $this->item_max_qtn_to_add_from_stockinhand($id);
if($qtnMore == 0)
{
unset($_SESSION['cart'][$id]);
}
elseif(isset($_REQUEST['increaseItem']))
{
if($item_max_qtn_by_stockinhand > $qtnMore)
{
$_SESSION['cart'][$id] ++;
}
else
{
unset($_SESSION['cart'][$id]);
}
}
elseif(isset($_REQUEST['reducedItem']))
{
if($qtnMore <= 1)
{
unset($_SESSION['cart'][$id]);
}
else
{
$_SESSION['cart'][$id] --;
}
}
else
{
$_SESSION['cart'][$id] = $qtnMore;
}
}

/* Total item */
public function total_items($cart)
{
$num_items = 0;
if(is_array($cart))
{
foreach ($cart as $id => $qty)
{
$num_items += $qty;
}
}
return $num_items;
}
/* Find Price by id  */
public function total_price($cart)
{
$price = 0.00;
if(is_array($cart))
{
foreach ($cart as $id => $qty)
{
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
$item_price = floatval(number_format($row['discountprice'],2,'.',''));
$price += $item_price * $qty;
number_format($price,2,'.','');
}
}
}
}
return $price;
}

/*** Checkout item_max_qtn can be purchase 2500kg devide item_weight ***/
public function item_max_qtn_to_add_from_stockinhand($id)
{
$id = intval($id);
$item_max_qtn_by_stockinhand = intval(0);
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
$item_max_qtn_by_stockinhand = $row['stockinhand'];
number_format($item_max_qtn_by_stockinhand,0,'.','');
}
}
return $item_max_qtn_by_stockinhand;
}

/*** Checkout item_max_qtn can be purchase 2500kg devide item_weight ***/
public function item_max_qtn_for_add($id)
{
$id = intval($id);
$item_max_qtn = intval(0);
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
/* $item_price = $row[0]; */
$item_weight = $row['s_weight'];
$item_stockinhand = $row['stockinhand'];
$max_kg = 2500.00;
$item_max_qtn = ($max_kg / $item_weight);
/*** ***/
number_format($item_max_qtn,0,'.','');
if($item_max_qtn >= $item_stockinhand)
{
$item_max_qtn = $item_stockinhand;
}
}
}
return $item_max_qtn;
}

/*** Checkout item_max_qtn can be purchase 2500kg devide item_weight ***/
public function item_max_qtn($id)
{
$id = intval($id);
$item_max_qtn = intval(0);
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
/* $item_price = $row[0]; */
$item_weight = $row['s_weight'];
$item_stockinhand = $row['stockinhand'];
$max_kg = 2500.00;
$item_max_qtn = ($max_kg / $item_weight);
/*** ***/
number_format($item_max_qtn,0,'.','');
if($item_max_qtn >= $item_stockinhand)
{
$item_max_qtn = $item_stockinhand;
}
}
}
return $item_max_qtn;
}

/* total_tax cart  */
public function total_tax($cart)
{
$tax = 0.00;
if(is_array($cart))
{
foreach ($cart as $id => $qty)
{
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
$item_tax_percent = floatval(number_format($row['s_vat_tax'],2,'.',''));

$item_tax_percent_of = floatval(number_format($row['discountprice'],2,'.',''));
$item_tax_1 = $item_tax_percent_of * ($item_tax_percent / 100);
$item_tax_2 = floatval(number_format($item_tax_1,2,'.',''));
$tax += $item_tax_2 * $qty;
}
}
/*** ***/
}
}
return $tax;
}

/* total_tax paypal  */
public function total_tax_paypal($id)
{
$id = intval($id);
$tax_paypal = 0.00;
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
$item_tax_percent = floatval(number_format($row['s_vat_tax'],2,'.',''));
$item_tax_percent_of = floatval(number_format($row['discountprice'],2,'.',''));
$tax_paypal = $item_tax_percent_of * ($item_tax_percent / 100);
$tax_paypal = floatval(number_format($tax_paypal,2,'.',''));
}
}
/*** ***/
return $tax_paypal;
}
/*** ***/
public function item_handling_paypal($id)
{
$id = intval($id);
$item_handling = 0.00;
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
$item_handling = floatval(number_format($row['s_handling_packing'],2,'.',''));
}
}
/*** ***/
return $item_handling;
}
/*** ***/
/* total_handling cart  */
public function total_handling($cart)
{
$handeling = 0.00;
if(is_array($cart))
{
foreach ($cart as $id => $qty)
{
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
$item_handeling = floatval(number_format($row['s_handling_packing'],2,'.',''));
$handeling += $item_handeling * $qty;
}
}
/*** ***/
}
}
return $handeling;
}
/*** ***/
public function product($id)
{
$id = intval($id);
$query ="SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_small_image_url, s_og_image_title, s_og_image_description, salse, (purchase - salse) AS stockinhand, (showroomprice - discount) AS discountprice, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date";
$query .=" FROM ( SELECT bay_showroom_approved_items_id, username_merchant_ai, tracking_unique_product_ai, s_category_a, s_category_b, s_category_c, s_category_d, s_og_small_image_url, s_og_image_title, s_og_image_description, SUM(s_stock) AS purchase, s_marked_price AS showroomprice, s_marked_price * s_discount_percent/100 AS discount, s_size, s_marked_price, s_discount_percent, s_vat_tax, s_weight, s_handling_packing, s_country_of_origin, s_date FROM bay_showroom_approved_items WHERE s_product_approved = 1 GROUP BY bay_showroom_approved_items_id";
$query .=" ) showroom";
$query .=" JOIN( SELECT tracking_unique_product_sr, SUM(sqtn_sr) AS salse, payment_status FROM bay_salse_report_stock_update WHERE payment_status = 'OK' GROUP BY tracking_unique_product_sr";
$query .=" ) s";
$query .=" ON tracking_unique_product_ai = s.tracking_unique_product_sr";
//
$query .=" WHERE salse >= 0 AND bay_showroom_approved_items_id=$id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
return $row;
}
}
}
/* add to Wishlist  */
public function addWish($idWish)
{
if(isset($_SESSION['ebusername']))
{
$productIdBay = $idWish;
$usernameBay = $_SESSION['ebusername'];
$likeDateBay = date("r");
$queryCheckBay = "SELECT * FROM bay_like WHERE bay_id_in_bay_like=$productIdBay AND bay_username='$usernameBay'";
$resultCheckBay = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheckBay);
$numResultWishBay = $resultCheckBay->num_rows;
if($numResultWishBay == 0)
{
$queryBay = "INSERT INTO bay_like SET bay_id_in_bay_like=$productIdBay, bay_username='$usernameBay', bay_like_date='$likeDateBay'";
$entryResult = eBConDb::eBgetInstance()->eBgetConection()->query($queryBay);
}
$result -> free_result();
}
}

/* End */
}
?>