<style>
    .app-header {
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

    /* Notification Bell (optional) */
    .header-icon {
        font-size: 1.4rem;
        color: #6c757d;
        cursor: pointer;
        transition: 0.2s ease;
    }
    .header-icon:hover {
        color: #0d6efd;
        transform: scale(1.12);
    }

    /* USER BOX */
    .user-info-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 18px;
        background: #f8f9fa;
        border-radius: 14px;
        transition: 0.25s ease;
        cursor: pointer;
        border: 1px solid #ececec;
    }

    .user-info-box:hover {
        background: #eef3ff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        transform: translateY(-1px);
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e3e3e3;
        box-shadow: 0 0 4px rgba(0,0,0,0.08);
    }

    .user-hello {
        color: #6c757d;
        font-size: 0.85rem;
        margin-bottom: -2px;
    }

    .user-name {
        font-weight: 600;
        color: #212529;
        font-size: 1.05rem;
        letter-spacing: 0.2px;
    }

    /* RIGHT SIDE LAYOUT */
    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }
</style>


<header class="app-header">

    <!-- LEFT (Breadcrumb / Title / Search có thể thêm sau) -->
    <div class="header-left">
        <!-- Bạn muốn thêm Tiêu đề trang? Search bar? Breadcrumb? -->
    </div>

    <!-- RIGHT -->
    <div class="header-right">

        <!-- ICON THÔNG BÁO (OPTIONAL) -->
        <i class="bi bi-bell header-icon"></i>

        <!-- USER INFO -->
        <div class="user-info-box">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($userName) ?>&background=0D6EFD&color=fff"
                 class="user-avatar" alt="avatar">

            <div class="d-flex flex-column">
                <span class="user-hello">Xin chào</span>
                <span class="user-name"><?= htmlspecialchars($userName) ?></span>
            </div>
        </div>

    </div>

</header>

