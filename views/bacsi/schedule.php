<?php /** @var array $bs */ /** @var string $ngay */ /** @var array $activeSlots */ /** @var array $bookedSlots */ ?>
<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<!-- bootstrap chỉ dùng cho MODAL + FORM (không đụng admin.css) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
/* CHẶN BOOTSTRAP ĐÈ ADMIN SIDEBAR/NAV */
.sidebar .nav,
.sidebar .nav * {
    all: unset;
}

/* khôi phục lại style nav của admin.css (tối thiểu) */
.sidebar .nav {
    display: block;
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar .nav li {
    display: block;
    margin-bottom: 6px;
}

.sidebar .nav a {
    display: block;
    padding: 10px 12px;
    text-decoration: none;
    color: var(--text);
    border-radius: 10px;
    font-size: 14px;
}

.sidebar .nav a:hover {
    background: var(--primary-soft);
    color: var(--primary);
}

/* chặn bootstrap đè body font/line-height quá mạnh (nhẹ thôi) */
body {
    line-height: normal;
}
</style>
<div class="page" style="max-width:1200px;margin:0 auto;">

    <div class="page-head" style="justify-content:flex-start; align-items:flex-start; gap:12px; flex-wrap:wrap;">
        <div>
            <div class="page-title"><?= e($bs['full_name'] ?? 'Chi tiết bác sĩ') ?></div>
            <div class="page-sub"><?= e($bs['gioi_thieu_ngan'] ?? '') ?></div>
        </div>

        <div class="actions" style="margin-left:0;">
            <a class="btn btn-outline" href="<?= e(base_url('index.php?c=bacsi&a=list')) ?>">← Danh sách</a>
        </div>
    </div>

    <?php if(!empty($_SESSION['flash_success'])): ?>
    <div class="alert">✅ <?= e($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
    <?php endif; ?>
    <?php if(!empty($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger">⚠️ <?= e($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
    <?php endif; ?>

    <div class="grid" style="grid-template-columns:360px 1fr; align-items:start;">
        <!-- LEFT -->
        <div class="card">
            <div style="font-weight:800;">Lịch khám</div>

            <div style="margin-top:10px;">
                <label style="display:block;margin-bottom:6px;font-size:13px;color:var(--muted);font-weight:700;">
                    Chọn ngày
                </label>
                <input type="date" id="ngay" class="input" value="<?= e($ngay ?? '') ?>" onchange="loadSlots()">
            </div>

            <div id="slotWrap" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:12px;"></div>

            <div style="font-size:12px;color:var(--muted);margin-top:10px;">
                Chọn giờ → mở form đặt lịch
            </div>
        </div>

        <!-- RIGHT -->
        <div class="card">
            <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
                <span class="tag"><?= e($bs['chuyen_khoa'] ?? 'Chưa cập nhật chuyên khoa') ?></span>
                <span class="tag">Giá khám: <?= number_format((int)($bs['gia_kham'] ?? 0)) ?>đ</span>
            </div>

            <div style="margin-top:14px; display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                <div>
                    <div class="card label">Bệnh viện</div>
                    <div style="font-weight:700;margin-top:6px;"><?= e($bs['benh_vien'] ?? '-') ?></div>
                </div>
                <div>
                    <div class="card label">Phòng khám</div>
                    <div style="font-weight:700;margin-top:6px;"><?= e($bs['phong_kham'] ?? '-') ?></div>
                </div>
                <div>
                    <div class="card label">Tỉnh thành</div>
                    <div style="font-weight:700;margin-top:6px;"><?= e($bs['tinh_thanh'] ?? '-') ?></div>
                </div>
            </div>

            <div style="height:1px;background:var(--border);margin:14px 0;"></div>

            <div style="font-weight:800;margin-bottom:6px;">Mô tả</div>
            <div><?= nl2br(e($bs['mo_ta_chi_tiet'] ?? 'Chưa có mô tả.')) ?></div>
        </div>
    </div>

</div>

<!-- MODAL đặt lịch: bootstrap handle -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;">
            <div class="modal-header">
                <div>
                    <div class="fw-bold">Thông tin đặt lịch khám bệnh</div>
                    <div class="text-muted" style="font-size:13px;">
                        <?= e($bs['full_name'] ?? '') ?> • <span id="mNgay"></span> • <span id="mSlot"></span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="<?= e(base_url('index.php?c=lichhen&a=create')) ?>">
                <div class="modal-body">
                    <input type="hidden" name="doctor_id" value="<?= (int)($bs['id'] ?? 0) ?>">
                    <input type="hidden" name="ngay" id="fNgay">
                    <input type="hidden" name="slot" id="fSlot">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên *</label>
                            <input class="form-control" name="ho_ten" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại *</label>
                            <input class="form-control" name="sdt" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input class="form-control" name="email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Địa chỉ liên lạc</label>
                            <input class="form-control" name="dia_chi">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Lý do khám</label>
                            <input class="form-control" name="ly_do_kham">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" name="ngay_sinh">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" name="gioi_tinh">
                                <option value="nam">Nam</option>
                                <option value="nu">Nữ</option>
                                <option value="khac">Khác</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-muted mt-3" style="font-size:13px;">
                        Giá khám: <b><?= number_format((int)($bs['gia_kham'] ?? 0)) ?>đ</b> • Miễn phí đặt lịch
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Xác nhận</button>
                    <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.slot {
    padding: 10px 12px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: #fff;
    font-weight: 800;
    font-size: 13px;
    min-width: 110px;
    text-align: center;
    cursor: pointer;
    user-select: none;
}

.slot.on {
    background: var(--primary-soft);
    border-color: rgba(14, 165, 164, .35);
    color: var(--primary);
}

.slot.off {
    opacity: .45;
    cursor: not-allowed;
}

@media (max-width: 900px) {
    .grid {
        grid-template-columns: 1fr !important;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const doctorId = <?= (int)($bs['id'] ?? 0) ?>;
const activeSlots = <?= json_encode($activeSlots ?? []) ?>;
const bookedSlots = <?= json_encode($bookedSlots ?? []) ?>;

function renderSlots(active, booked) {
    const wrap = document.getElementById('slotWrap');
    wrap.innerHTML = '';

    active.forEach(slot => {
        const div = document.createElement('div');
        div.className = 'slot on';
        div.textContent = slot;

        if (booked.includes(slot)) {
            div.className = 'slot off';
            div.title = 'Đã có người đặt';
        } else {
            div.onclick = () => openModal(slot);
        }
        wrap.appendChild(div);
    });

    if (active.length === 0) {
        wrap.innerHTML = '<div style="font-size:13px;color:var(--muted);">Chưa có lịch cho ngày này.</div>';
    }
}

function openModal(slot) {
    const ngay = document.getElementById('ngay').value;

    document.getElementById('mNgay').textContent = ngay;
    document.getElementById('mSlot').textContent = slot;

    document.getElementById('fNgay').value = ngay;
    document.getElementById('fSlot').value = slot;

    bootstrap.Modal.getOrCreateInstance(document.getElementById('bookModal')).show();
}

async function loadSlots() {
    const ngay = document.getElementById('ngay').value;
    const url = `index.php?c=bacsi&a=slots&id=${doctorId}&ngay=${encodeURIComponent(ngay)}`;
    const res = await fetch(url);
    const data = await res.json();
    renderSlots(data.active || [], data.booked || []);
}

document.addEventListener('DOMContentLoaded', () => renderSlots(activeSlots, bookedSlots));
</script>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>