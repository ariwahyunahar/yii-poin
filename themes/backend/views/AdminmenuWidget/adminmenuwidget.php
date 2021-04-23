<div id="primarymenu" class="primarymenu">

    <ul id="nav">
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin" id="menu-dashboard">Dashboard</a></li>
        <li><a href="#" id="menu-content_management">Content Management</a>
            <ul>
                <li class="first"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content">Content &nbsp;&raquo;</a>
                    <ul>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content">List</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/content/create">Create Content</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/contenttype">Content Type &nbsp;&raquo;</a>
                    <ul>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/contenttype">List</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/contenttype/create">Create Content Type</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/document">Docment Browser &nbsp;&raquo;</a>
                	<ul>
                    	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/document/settings">Settings</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/documenttisna">BPJS Browser</a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/docspt">SPT</a></li>
                
            </ul>
        </li>
        <li><a href="#" id="menu-site_building">Site Building</a>
            <ul class="sub_menu">
                <li class="first"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu">Menu &nbsp;&raquo;</a>
                    <ul>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu">List Menu</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/menu/add">Add Menu</a></li>
                    </ul>
                </li>
                <li><a href="#">Themes &nbsp;&raquo;</a>
                	<ul>
                    	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/theme">List</a></li>
                    </ul>
                </li>
                <li><a href="#">Modules &nbsp;&raquo;</a>
                	<ul>
                    	<li><a href="#">Kurs</a></li>
                    	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/polling">Polling &nbsp;&raquo;</a>
                        	<ul>
                            	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/polling">Settings</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
				 <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/siteconfigure">Site Configure &nbsp;&raquo;</a>
                	<ul>
                    	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/siteconfigure">Settings</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#" id="menu-report">Reports</a>
        	<ul class="sub_menu">
            	<li class="first"><a href="<?php echo Yii::app()->request->baseurl; ?>/admin/report/content">Top Content Hits</a></li>
            </ul>
        </li>
        <li><a href="#" id="menu-user_management">User Management</a>
            <ul class="sub_menu">
                <li class="first"><a href="#">Group &nbsp;&raquo;</a>
                	<ul>
                    	<li><a href="#">List</a></li>
                    </ul>
                </li>
                <li><a href="#">Permission &nbsp;&raquo;</a>
                	<ul>
                    	<li><a href="#">List</a></li>
                    </ul>
                </li>
                <li><a href="#">Users &nbsp;&raquo;</a>
                	<ul>
                    	<li><a href="#">List</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/member">Member &nbsp;&raquo;</a>
                	<ul>
                    	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/member">List</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    
    <ul id="logout">
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/logout" id="menu-logout">Logout</a></li>
    </ul>
    <div class="clear"></div>

</div>