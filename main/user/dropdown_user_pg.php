<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a
        class="nav-link dropdown-toggle hide-arrow p-0"
        href="javascript:void(0);"
        data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <?php
            include '../../config/koneksi.php';

            if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                $id = $_SESSION['id'];
                $role = $_SESSION['role'];

                $query = mysqli_query($conn, "SELECT avatar FROM users WHERE id = '$id' AND role = '$role'");
                $data = mysqli_fetch_assoc($query);

                if ($data && !empty($data['avatar'])) {
                    $avatarPath = '../../assetss/img/avatars/' . htmlspecialchars($data['avatar']);
                    echo '<img src="' . $avatarPath . '" alt="Avatar" class="w-px-40 h-auto rounded-circle" />';
                } else {
                    echo '<img src="../../assetss/img/avatars/default.png" alt="Avatar" class="w-px-40 h-auto rounded-circle" />';
                }
            } else {
                echo '<img src="../../assetss/img/avatars/2.png" alt class="w-px-40 h-auto rounded-circle" />';
            }
            ?>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="#">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                            <?php
                            include '../../config/koneksi.php';

                            if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                                $id = $_SESSION['id'];
                                $role = $_SESSION['role'];

                                $query = mysqli_query($conn, "SELECT avatar FROM users WHERE id = '$id' AND role = '$role'");
                                $data = mysqli_fetch_assoc($query);

                                if ($data && !empty($data['avatar'])) {
                                    $avatarPath = '../../assetss/img/avatars/' . htmlspecialchars($data['avatar']);
                                    echo '<img src="' . $avatarPath . '" alt="Avatar" class="w-px-40 h-auto rounded-circle" />';
                                } else {
                                    echo '<img src="../../assetss/img/avatars/default.png" alt="Avatar" class="w-px-40 h-auto rounded-circle" />';
                                }
                            } else {
                                echo '<img src="../../assetss/img/avatars/default.png" alt="Avatar" class="w-px-40 h-auto rounded-circle" />';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <?php
                        include '../../config/koneksi.php';

                        if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                            $id = $_SESSION['id'];
                            $role = $_SESSION['role'];

                            $query = mysqli_query($conn, "SELECT nama, bidang FROM users WHERE id = '$id' AND role = '$role'");
                            $data = mysqli_fetch_assoc($query);

                            if ($data) {
                                echo '<h6 class="mb-0">' . htmlspecialchars($data['nama']) . '</h6>';
                                echo '<small class="text-body-secondary">' . htmlspecialchars($data['bidang']) . '</small>';
                            } else {
                                echo '<small class="text-danger">Data pengguna tidak ditemukan.</small>';
                            }
                        } else {
                            echo '<small class="text-danger">Session belum tersedia. Silakan login ulang.</small>';
                        }
                        ?>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider my-1"></div>
        </li>
        <li>
            <a class="dropdown-item" href="lihat_profile.php">
                <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="logout.php">
                <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
            </a>
        </li>
    </ul>
</li>