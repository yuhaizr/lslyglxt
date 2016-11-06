<?php
return array(

	
	array(
			'title' => '系统管理',
			'link' => '/Home/System',
			'icon' => '',
			'childs' => array(
                array(
                    'title' => '角色列表',
                    'link' => '/Home/Role/roleList?type=menu'
                ),
		        array(
		                'title' => '用户列表',
		                'link' => '/Home/User/userList?type=menu'
		        ),
			)
	),	
    array(
        'title' => '景区管理',
        'link'  => 'Home/ScenicArea',
        'icon' => '',
        'childs' => array(
/*             array(
                'title' => '添加景区',
                'link' => '/Home/ScenicArea/addScenicArea?type=menu'
            ),
            array(
                'title' => '景区列表',
                'link' => '/Home/ScenicArea/scenicAreaList?type=menu'
            ), */
            array(
                'title' => '添加景点',
                'link' => '/Home/ScenicSpot/add?type=menu'
            ),            
            array(
                'title' => '景点列表',
                'link' => '/Home/ScenicSpot/showList?type=menu'
            ), 
            array(
                'title' => '添加酒店',
                'link' => '/Home/Hotel/add?type=menu'
            ),
            array(
                'title' => '酒店列表',
                'link' => '/Home/Hotel/showList?type=menu'
            ),            
            array(
                'title' => '添加庐山特产',
                'link' => '/Home/LocalProduct/add?type=menu'
            ),
            array(
                'title' => '庐山特产列表',
                'link' => '/Home/LocalProduct/showList?type=menu'
            ),            
        )
    ),
    array(
        'title' => '路线管理',
        'link' => '/Home/TourRoute',
        'icon' => '',
        'childs' => array(
            array(
                'title' => '路线列表',
                'link' => '/Home/TourRoute/showList?type=menu'
            ),
            array(
                'title' => '添加旅游路线',
                'link' => '/Home/TourRoute/add?type=menu'
            ),
        )
    ),
    array(
        'title' => '考勤管理',
        'link' => '/Home/CheckWork',
        'icon' => '',
        'childs' => array(
            array(
                'title' => '员工考勤',
                'link' => '/Home/CheckWork/add?type=menu'
            ),
            array(
                'title' => '考勤记录',
                'link' => '/Home/CheckWork/showList?type=menu'
            ),
        )
    ),
	array(
			'title' => '游客反馈',
			'link' => '/Home/Suggestion',
			'icon' => '',
			'childs' => array(
                array(
                    'title' => '意见列表',
                    'link' => '/Home/Suggestion/showList?type=menu'
                ),
		        array(
		                'title' => '意见反馈',
		                'link' => '/Home/Suggestion/add?type=menu'
		        ),
			)
	),	
    array(
        'title' => '统计分析',
        'link' => '/Home/Visitors',
        'icon' => '',
        'childs' => array(
            array(
                'title' => '人流量列表',
                'link' => '/Home/Visitors/showList?type=menu'
            ),
            array(
                'title' => '添加人流量',
                'link' => '/Home/Visitors/add?type=menu'
            ),
            array(
                'title' => '庐山总人流量统计',
                'link' => '/Home/Visitors/countTotal?type=menu'
            ),
            array(
                'title' => '各景点人流量统计',
                'link' => '/Home/Visitors/count?type=menu'
            ),            
        )
    ),
		
)
?>