<div class="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-university"></i> Sistem KRS</h3>
    </div>
    
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="../mahasiswa/index.php">
                <i class="fas fa-tachometer-alt"></i> Mahasiswa
            </a>
        </li>
        <li class="menu-item">
            <a href="../matakuliah/index.php">
                <i class="fas fa-edit"></i> Mata Kuliah
            </a>
        </li>
        <li class="menu-item active">
            <a href="../krs/index.php">
                <i class="fas fa-users"></i> KRS
            </a>
        </li>
    </ul>
</div>

<style>
/* Updated Sidebar Styles with Indigo-500 */
.sidebar {
    width: 280px;
    height: 100vh;
    background-color: #6366F1; /* Indigo-500 */
    color: white;
    position: fixed;
    left: 0;
    top: 0;
    box-shadow: 2px 0 15px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    z-index: 1000;
}

.sidebar-header {
    padding: 25px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.sidebar-header h3 {
    margin: 0;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
}

.sidebar-header h3 i {
    margin-right: 10px;
}

.sidebar-menu {
    flex: 1;
    list-style: none;
    padding: 10px 0;
    margin: 0;
    overflow-y: auto;
}

.menu-item {
    padding: 12px 25px;
    transition: all 0.3s;
}

.menu-item:hover {
    background: rgba(255,255,255,0.1);
}

.menu-item.active {
    background: rgba(255,255,255,0.2);
    border-left: 4px solid #fff;
}

.menu-item a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.menu-item a i {
    margin-right: 12px;
    width: 20px;
    text-align: center;
    font-size: 1.1rem;
}
</style>