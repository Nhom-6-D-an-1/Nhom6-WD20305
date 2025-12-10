<style>
    .admin-header {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(230, 230, 230, 0.7);
        padding: 14px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 4px 18px rgba(0,0,0,0.05);
    }

    .admin-user-box {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 1px solid #ececec;
        transition: 0.25s ease;
        cursor: pointer;
    }

    .admin-user-box:hover {
        background: #eef3ff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        transform: translateY(-1px);
    }

    .admin-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e3e3e3;
    }

    .user-hello {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .user-name {
        font-weight: 600;
        font-size: 1.05rem;
        color: #212529;
    }

    .admin-icon {
        font-size: 1.4rem;
        color: #6c757d;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .admin-icon:hover {
        color: #0d6efd;
        transform: scale(1.12);
    }
</style>

<header class="admin-header">

    <!-- LEFT PLACEHOLDER (sau này có thể thêm search hoặc title trang) -->
    <div class="header-left"></div>

    <!-- RIGHT: USER AREA -->
    <div class="d-flex align-items-center gap-3 me-4">

        <!-- Notification Bell (optional) -->
        <i class="bi bi-bell admin-icon"></i>

        <!-- USER INFO -->
        <div class="admin-user-box">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($userName) ?>&background=0D6EFD&color=fff"
                 class="admin-avatar" alt="avatar">

            <div class="d-flex flex-column">
                <span class="user-hello">Xin chào</span>
                <span class="user-name"><?= htmlspecialchars($userName) ?></span>
            </div>
        </div>

    </div>

</header>
