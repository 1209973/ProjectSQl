

<?php


$navbar ='

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="wrapper" >

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" align="center" style="color: #ffffff">
                <li class="sidebar-brand">
                    <a href="#">

</a>
                </li>
                <li><a href="#details" > <i class="material-icons home" ></i>
                        Dashboard
                    </a>

                </li>
                ';
if( $_SESSION['role']=='Admin') {
    $navbar .= '
                <li><a href="#student" > <span class="fa fa-user  fa-2x " ></span>

                        Students
                    </a>
                </li>
                <li><a href="#professor" >  <span class="fa fa-user  fa-2x " ></span>
                        Professor
                    </a>
                </li>
                <li><a href="#department" >  <span class="fa fa-building fa-2x " ></span>
                        Department
                    </a>
                </li>
                <li>
                ';
}
if( $_SESSION['role']!='Professor') {
    $navbar .= ' <li><a href="#CompanySession" > <span class="material-icons  library_books" ></span>
                        Company Session
                    </a>
                <li>';
}
if( $_SESSION['role']=='Professor') {
    $navbar .= '
               <li><a href="#AuthoredBookDetails" > <span class="fa fa-book fa-2x " ></span>
                        Authored Books
                    </a>
                <li>
                ';
}

$navbar .= '      <li><a href="#grades" > <span class="fa fa-graduation-cap  fa-2x " ></span>
                        Grades
                    </a>
                <li>
                <li><a href="#courses" ><span class="fa fa-user  fa-2x " ></span>
                        Courses
                    </a>
                <li>
                
                <li><a href="#library" ><span class="fa fa-book fa-2x " ></span>
                        Library
                    </a>
                <li>
               


            </ul>
        </div>


    </div>
   
    ';

echo $navbar;