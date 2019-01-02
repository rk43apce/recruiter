  <nav id="sidebar">
            <div class="sidebar-header">
               <img src="../img/blueyedunison.jpg" width="100%">
            </div>

            <ul class="list-unstyled components">
            <center>
            <img id="profilePicture" style="cursor: pointer; " data-toggle="modal" data-target="#profilePictureModal"  class="rounded-circle" src="https://media.licdn.com/dms/image/C4E03AQEMEL2XAquuvQ/profile-displayphoto-shrink_200_200/0?e=1551916800&amp;v=beta&amp;t=biDfo3MsU_lZAPuJ_K0DrpTuJhgb3pdxUjxKYARGMk8"  alt="Edit photo" height="128" width="128">
            </center>
                <p style="text-align:center;"><?php echo Session::get('employeeName'); ?> </p>
<!--
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
-->
            </ul>

            <ul class="list-unstyled CTAs">               
                <li>
                    <a href="./dashboard.php" class="download">Back to Dashboard</a>
                </li>
            </ul>
        </nav>