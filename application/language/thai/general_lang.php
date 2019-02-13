<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// app
$lang['app_name'] = 'eqBorrow - ระบบเบิกจ่ายหมวดทางหลวงพร้าว';

// menu
$lang['menu_dashboard'] = 'หน้าหลัก';
$lang['menu_category'] = 'ประเภทวัสดุ';
$lang['menu_department'] = 'แผนก';
$lang['menu_member'] = 'สมาชิก';
$lang['menu_membertype'] = 'ประเภทสมาชิก';
$lang['menu_product'] = 'วัสดุ';
$lang['menu_user'] = 'ผู้ใช้งาน';
$lang['menu_usertype'] = 'ประเภทผู้ใช้งาน';
$lang['menu_borrow'] = 'เบิก-จ่าย';
$lang['menu_auth'] = 'ตรวจสอบการเข้าถึง';
$lang['menu_rpt_stock'] = 'รายงานวัสดุคงเหลือ';
$lang['menu_rpt_borrow'] = 'รายงานเบิกจ่ายวัสดุ';

// datatable
$lang['dt_listdata'] = 'ข้อมูลรายการ';

// dashboard
$lang['dsh_borrow'] = 'รายการเบิกจ่าย';
$lang['dsh_borrow_desc'] = 'จำนวนรายการที่มีรายการเบิกจ่าย';
$lang['dsh_member'] = 'รายการสมาชิก';
$lang['dsh_member_desc'] = 'จำนวนสมาชิกที่ใช้งาน';
$lang['dsh_product'] = 'รายการวัสดุ';
$lang['dsh_product_desc'] = 'จำนวนวัสดุที่ใช้งาน';
$lang['dsh_remain_return'] = 'รายการค้างคืน';
$lang['dsh_remain_return_desc'] = 'จำนวนรายการที่ยังไม่ได้คืนวัสดุ';
$lang['dsh_last_login'] = 'ผู้ใช้เข้าสู่ระบบล่าสุด';
$lang['dsh_last_borrow_product'] = 'วัสดุเบิกจ่ายล่าสุด';

// category
$lang['cat_name'] = 'ชื่อประเภทวัสดุ';

// product
$lang['prd_name'] = 'ชื่อวัสดุ';
$lang['prd_code'] = 'รหัสวัสดุ';
$lang['prd_model'] = 'รุ่น';
$lang['prd_price'] = 'ราคา';
$lang['prd_fine'] = 'ค่าปรับ';
$lang['prd_serial_number'] = 'หมายเลข Serial No.';
$lang['prd_quantity'] = 'จำนวน';
$lang['prd_detail'] = 'รายละเอียด';
$lang['prd_is_serial_number'] = 'ใช้งาน Serial No.';
$lang['prd_is_return'] = 'วัสดุคืนได้';

// department
$lang['dep_name'] = 'ชื่อแผนก';

// member type
$lang['mbt_name'] = 'ชื่อประเภทสมาชิก';

// member
$lang['mem_name'] = 'ชื่อ-นามสกุล';
$lang['mem_code'] = 'รหัสสมาชิก';
$lang['mem_username'] = 'Username';
$lang['mem_password'] = 'Password';
$lang['mem_repassword'] = 'Re-password';
$lang['mem_email'] = 'อีเมล์';
$lang['mem_tel'] = 'เบอร์โทรศัพท์';
$lang['mem_address'] = 'ที่อยู่';
$lang['mem_idcard'] = 'เลขบัตรประจำตัวประชาชน';

// user
$lang['usr_username'] = 'ชื่อผู้ใช้งาน';
$lang['usr_password'] = 'รหัสผ่าน';
$lang['usr_conf_password'] = 'ยืนยันรหัสผ่าน';
$lang['usr_fullname'] = 'ชื่อ-นามสกุล';
$lang['usr_usertype'] = 'ประเภทผู้ใช้งาน';

// borrow
$lang['bow_code'] = 'รหัสผู้เบิก';
$lang['bow_name'] = 'ชื่อผู้เบิก';
$lang['bow_borrow_date'] = 'วันที่เบิก';
$lang['bow_schedule_date'] = 'กำหนดคืน';
$lang['bow_return_status'] = 'สถานะ';
$lang['bow_cannot_delete'] = 'ไม่สามารถลบได้เนื่องจากมีรายการคืนแล้ว';

// borrow detail
$lang['bod_return_status'] = 'สถานะการคืน';
$lang['bod_borrow_quantity'] = 'จำนวนเบิก';
$lang['bod_return_quantity'] = 'จำนวนคืน';
$lang['bod_total_quantity'] = 'จำนวนคงเหลือ';
$lang['bod_price'] = 'ราคา';
$lang['bod_find'] = 'ค่าปรับ';
$lang['bod_issue'] = 'ปัญหา';
$lang['bod_return_date'] = 'วันที่คืน';

// global
$lang['action'] = 'การกระทำ';
$lang['add'] = 'เพิ่ม';
$lang['edit'] = 'แก้ไข';
$lang['approve'] = 'อนุมัติ';
$lang['return'] = 'คืน';
$lang['delete'] = 'ลบ';
$lang['active'] = '';
$lang['status'] = 'สถานะ';
$lang['unit'] = 'หน่วยนับ';
$lang['login'] = 'เข้าสู่ระบบ';
$lang['logout'] = 'ออกจากระบบ';
$lang['resetpass'] = 'เปลี่ยนรหัสผ่านใหม่';
$lang['forgotpass'] = 'ลืมรหัสผ่าน';
$lang['back_to_login'] = 'กลับไปหน้าเข้าสู่ระบบ';
$lang['stay_login'] = 'คงอยู่ในระบบ';
$lang['err_invalid_login'] = 'ชื่อผู้ใช้หรือรหัสผ่านผิด!';
$lang['err_auth'] = 'กรุณาเข้าสู่ระบบ!';
$lang['total'] = 'รวม';
$lang['no_record'] = 'ไม่มีรายการ';
$lang['negative_stock'] = 'จำนวนวัสดุไม่เพียงพอ';
$lang['updated'] = 'ปรับปรุงเมื่อ';
$lang['trans_date'] = 'วันที่ทำรายการ';

// button
$lang['ok'] = 'ตกลง';
$lang['save'] = 'บันทึก';
$lang['cancel'] = 'ยกเลิก';
$lang['close'] = 'ปิด';
$lang['create'] = 'สร้างใหม่';
$lang['refresh'] = 'โหลดใหม่';
$lang['add'] = 'เพิ่ม';
$lang['send'] = 'ส่งข้อมูล';

// message arert
$lang['not_delete_trans'] = 'ไม่สามารถลบได้ มีรายการข้อมูลอื่น';
$lang['system_error'] = 'ระบบผิดพลาด กรุณาติดต่อผู้ดูแลระบบ';