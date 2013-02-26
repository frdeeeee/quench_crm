<?php 
	App::uses('AppHelper', 'View/Helper');
	class MytextHelper extends AppHelper{
		private $content = array(
				0=>array(
						'welcome'=>'欢迎来到优势',
						'txt_login'=>'登陆系统',
						'title_choose_group'=>'请选择您的工作组',
						'txt_choose_group'=>'登录到：',
						'txt_choose_task'=>'选择任务：',
						'txt_start'=>'开始工作',
						'login_tip_1'=>'',
						'username_tip' =>'电子邮件',
						'password_tip'=>'登录密码',
						'login_btn_tip'=>'滑动这里登录',
						'student_login_tip'=>'学生用户登录',
						'home' => '首页',
						'statistics_admin' => '统计报表',
						'statistics_admin_sub' => array(
								array('title'=>'销售部数据统计表','controller'=>'Sales','action'=>'load_admin'),
								array('title'=>'运营部数据统计表','controller'=>'Applicants','action'=>'load_statistic_admin')
						),
						'announcements_admin' => 'Notifications',
						'announcements_admin_sub' => array(
								array('title'=>'Add new','controller'=>'Announcements','action'=>'add'),
								array('title'=>'List All','controller'=>'Announcements','action'=>'list_all')
						),
						'tasks' => 'Projects Management',
						'tasks_sub' => array(
								array('title'=>'List All','controller'=>'Projects','action'=>'list_all'),
								array('title'=>'Add new','controller'=>'Tasks','action'=>'add')
						),
						'users' => 'System Accounts',
						'users_sub' => array(
								array('title'=>'Add new','controller'=>'Users','action'=>'add'),
								//array('title'=>'User Group','controller'=>'Groups','action'=>'list_all'),
								array('title'=>'List All','controller'=>'Users','action'=>'list_all')
						),
						'message_box' => 'Messages',
						'message_box_sub' => array(
								array('title'=>'Inbox','controller'=>'ShortMessages','action'=>'list_all_in_box'),
								array('title'=>'Outbox','controller'=>'ShortMessages','action'=>'list_all_send_box')
						),
						'meetings' => 'Sales Management',
						'meetings_sub' => array(
								array('title'=>'List All Meetings','controller'=>'Meetings','action'=>'list_all'),
								array('title'=>'Set up a meeting','controller'=>'Meetings','action'=>'add')
								),
						'contacts' => 'Contacts',
						'contacts_sub' => array(
								array('title'=>'List All','controller'=>'Contacts','action'=>'list_all'),
								array('title'=>'List Cold Leads','controller'=>'Contacts','action'=>'list_all_cold'),
								array('title'=>'List Hot Leads','controller'=>'Contacts','action'=>'list_all_hot'),
								array('title'=>'List Referral','controller'=>'Contacts','action'=>'list_all_referral'),
								array('title'=>'List Others','controller'=>'Contacts','action'=>'list_all_others')
								),
						'clients' => 'Clients',
						'clients_sub' => array(
								array('title'=>'List All','controller'=>'Clients','action'=>'list_all')
								),
						'workinglogs' => 'Working Logs',
						'workinglogs_sub' => array(
								array('title'=>'New','controller'=>'WorkingLogs','action'=>'add'),
								array('title'=>'List All','controller'=>'WorkingLogs','action'=>'list_all')
								),
						'students' => '申请进度管理',
						'students_sub' => array(
								array('title'=>'我的个人信息','controller'=>'Students','action'=>'basic_info')
								),
						'filemanagers' => '项目模版文件管理',
						'filemanagers_sub' => array(
								array('title'=>'模版文件列表','controller'=>'DownloadFiles','action'=>'list_all')
								),
						'smsmanagers' => '短信模板管理',
						'smsmanagers_sub' => array(
								array('title'=>'短信模板列表','controller'=>'TextingTemplates','action'=>'list_all')
						),
						'navi_top_meeting' => '会议管理',
						'navi_top_calendar' => '我的日程',
						'navi_top_add_working_log' => '添加工作记录',
						'navi_top_add_note' => '撰写便条',
						'navi_top_file' => '常用文件下载',
						'navi_top_news' => '公司公告'
						),
				1=>array(
						'welcome'=>'Welcome to Youth-edu',
						'txt_login'=>'Enter',
						'title_choose_group'=>'Enter Group Info',
						'txt_choose_group'=>'Your group',
						'txt_choose_task'=>'Your Task',
						'txt_start'=>'Start',
						'login_tip_1'=>'Please enter your details to login.',
						'username_tip'=>'Username<span>or email address',
						'password_tip'=>'Password',
						'login_btn_tip'=>'Slide to Login',
						'student_login_tip'=>'Student Login'
						),
				2=>array(
						'welcome'=>'欢迎来到优势',
						'txt_login'=>'登陆系统',
						'title_choose_group'=>'请选择您的工作组',
						'txt_choose_group'=>'登录到：',
						'txt_choose_task'=>'选择任务：',
						'txt_start'=>'开始工作',
						'login_tip_1'=>'',
						'username_tip' =>'电子邮件',
						'password_tip'=>'登录密码',
						'login_btn_tip'=>'滑动这里登录',
						'student_login_tip'=>'学生用户登录',
						'home' => '首页',
						'statistics_admin' => '统计报表',
						'statistics_admin_sub' => array(
								array('title'=>'销售部数据统计表','controller'=>'Sales','action'=>'load_admin'),
								array('title'=>'运营部数据统计表','controller'=>'Applicants','action'=>'load_statistic_admin')
						),
						'announcements_admin' => '公司公告管理',
						'announcements_admin_sub' => array(
								array('title'=>'发布新公告','controller'=>'Announcements','action'=>'add'),
								array('title'=>'查看所有公告','controller'=>'Announcements','action'=>'list_all')
						),
						'enquiries_oper' => '本年度运营数据管理',
						'enquiries_oper_sub' => array(
								array('title'=>'添加新的报名学生','controller'=>'Enquiries','action'=>'add'),
								array('title'=>'报名阶段学生管理','controller'=>'Enquiries','action'=>'list_all_for_operator'),
								array('title'=>'申请阶段学生管理','controller'=>'Applicants','action'=>'list_all_in_phase_apply'),
								array('title'=>'签证材料准备阶段学生管理','controller'=>'Applicants','action'=>'list_all_in_phase_visa_prepair'),
								array('title'=>'安置阶段学生管理','controller'=>'Applicants','action'=>'list_all_in_phase_settle'),
								array('title'=>'签证阶段学生管理','controller'=>'Applicants','action'=>'list_all_in_phase_visa'),
								array('title'=>'行前阶段学生管理','controller'=>'Applicants','action'=>'list_all_in_phase_before_leaving'),
								array('title'=>'赴美阶段学生管理','controller'=>'Applicants','action'=>'list_all_in_phase_oversea'),
								array('title'=>'回国阶段学生管理','controller'=>'Applicants','action'=>'list_all_in_phase_return'),
								array('title'=>'已删除报名表','controller'=>'Enquiries','action'=>'list_all_removed'),
								array('title'=>'统计数据汇总','controller'=>'Applicants','action'=>'load_statistic_operator')
						),
						'tasks' => '销售任务管理',
						'tasks_sub' => array(
								array('title'=>'项目管理','controller'=>'Projects','action'=>'list_all'),
								array('title'=>'创建销售任务','controller'=>'Tasks','action'=>'add')
						),
						'users' => '系统用户管理',
						'users_sub' => array(
								array('title'=>'增加新用户','controller'=>'Users','action'=>'add'),
								array('title'=>'用户组管理','controller'=>'Groups','action'=>'list_all'),
								array('title'=>'系统用户列表','controller'=>'Users','action'=>'list_all')
						),
						'enquiries' => '销售记录管理',
						'enquiries_sub' => array(
								array('title'=>'学生报名当日登记','controller'=>'Enquiries','action'=>'add'),
								array('title'=>'我的报名登记','controller'=>'Enquiries','action'=>'list_all_for_operator'),
								array('title'=>'申请阶段学生','controller'=>'Applicants','action'=>'list_all_in_phase_apply'),
								array('title'=>'签证阶段学生','controller'=>'Applicants','action'=>'list_all_in_phase_visa'),
								array('title'=>'赴美阶段学生','controller'=>'Applicants','action'=>'list_all_in_phase_oversea'),
								array('title'=>'返点费用记录表','controller'=>'Enquiries','action'=>'list_money_return'),
								array('title'=>'已删除报名表','controller'=>'Enquiries','action'=>'list_all_removed'),
								array('title'=>'统计汇总','controller'=>'Enquiries','action'=>'list_all')
						),
						'message_box' => '站内消息',
						'message_box_sub' => array(
								array('title'=>'收信箱','controller'=>'ShortMessages','action'=>'list_all_in_box'),
								array('title'=>'发信箱','controller'=>'ShortMessages','action'=>'list_all_send_box')
						),
						'presentations' => '宣讲会管理',
						'presentations_sub' => array(
								array('title'=>'宣讲会登记','controller'=>'Presentations','action'=>'add'),
								array('title'=>'过往记录','controller'=>'Presentations','action'=>'statistic_report')
						),
						'business_trip' => '出差管理',
						'customers' => '客户关系管理',
						'customers_sub' => array(
								array('title'=>'新建客户资料','controller'=>'Customers','action'=>'add'),
								//array('title'=>'新建联系人资料','controller'=>'Contacts','action'=>'add'),
								array('title'=>'已有客户资料','controller'=>'Customers','action'=>'list_all')
								),
						'workinglogs' => '客户交往纪录管理',
						'workinglogs_sub' => array(
								array('title'=>'新交往记录','controller'=>'WorkingLogs','action'=>'add'),
								array('title'=>'客户交往记录管理','controller'=>'WorkingLogs','action'=>'list_all')
								),
						'students' => '申请进度管理',
						'students_sub' => array(
								array('title'=>'我的个人信息','controller'=>'Students','action'=>'basic_info')
								),
						'filemanagers' => '项目模版文件管理',
						'filemanagers_sub' => array(
								array('title'=>'模版文件列表','controller'=>'DownloadFiles','action'=>'list_all')
								),
						'smsmanagers' => '短信模板管理',
						'smsmanagers_sub' => array(
								array('title'=>'短信模板列表','controller'=>'TextingTemplates','action'=>'list_all')
						),
						'navi_top_meeting' => '会议管理',
						'navi_top_calendar' => '我的日程',
						'navi_top_add_working_log' => '添加工作记录',
						'navi_top_add_note' => '撰写便条',
						'navi_top_file' => '常用文件下载',
						'navi_top_news' => '公司公告'
						),
				);
		
		public function output($key = null,$language = LANG){
			return (isset($this->content[$language][$key]))?$this->content[$language][$key]:'No content define';
		}
	}
	