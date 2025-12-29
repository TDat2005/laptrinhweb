<?php
/** @var string $title */
/** @var array $doctors */
/** @var int $doctorId */
/** @var string $ngay */
/** @var array $allSlots */
/** @var array $activeSlots */
?>
<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<div class="page" style="max-width:1100px;margin:0 auto;">

    <div class="page-head" style="justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;">
        <div>
            <div class="page-title"><?= e($title ?? 'Quản lý kế hoạch khám') ?></div>
            <div class="page-sub">Admin chọn bác sĩ + ngày → tick giờ làm → lưu vào hệ thống</div>
        </div>
    </div>

    <?php if(!empty($_SESSION['flash_success'])): ?>
    <div class="alert">✅ <?= e($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
    <?php endif; ?>
    <?php if(!empty($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger">⚠️ <?= e($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
    <?php endif; ?>

    <div class="grid" style="grid-template-columns:360px 1fr;align-items:start;gap:14px;">
        <!-- LEFT: chọn bác sĩ + ngày -->
        <div class="card">
            <div style="font-weight:900;">Chọn bác sĩ</div>

            <div style="margin-top:10px;">
                <label style="display:block;margin-bottom:6px;font-size:13px;color:var(--muted);font-weight:800;">Bác
                    sĩ</label>
                <select id="doctor_id" class="input" onchange="loadSlots()">
                    <?php foreach($doctors as $d): ?>
                    <option value="<?= (int)$d['id'] ?>" <?= ((int)$d['id']===(int)$doctorId) ? 'selected' : '' ?>>
                        <?= e(($d['full_name'] ?? 'Bác sĩ')." (#".(int)$d['id'].")") ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-top:10px;">
                <label style="display:block;margin-bottom:6px;font-size:13px;color:var(--muted);font-weight:800;">Chọn
                    ngày</label>
                <input type="date" id="ngay" class="input" value="<?= e($ngay) ?>" onchange="loadSlots()">
            </div>

            <div style="font-size:12px;color:var(--muted);margin-top:10px;">
                Tick các khung giờ → bấm <b>Lưu lịch</b>.
            </div>
        </div>

        <!-- RIGHT: tick giờ + lưu -->
        <div class="card">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;">
                <div style="font-weight:900;">Thiết lập khung giờ</div>

                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                    <button type="button" class="btn btn-outline" onclick="checkAll(true)">Chọn tất cả</button>
                    <button type="button" class="btn btn-outline" onclick="checkAll(false)">Bỏ chọn</button>
                </div>
            </div>

            <form id="frm" method="post" action="<?= e(base_url('index.php?c=adminSchedule&a=save')) ?>"
                style="margin-top:12px;">
                <input type="hidden" name="doctor_id" id="f_doctor_id" value="<?= (int)$doctorId ?>">
                <input type="hidden" name="ngay" id="f_ngay" value="<?= e($ngay) ?>">

                <div id="slotsBox" style="display:flex;flex-wrap:wrap;gap:10px;"></div>

                <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap;">
                    <button class="btn btn-primary" type="submit">Lưu lịch</button>
                    <a class="btn btn-outline" id="shareLink" href="#">Mở trang này</a>
                </div>

                <div style="font-size:12px;color:var(--muted);margin-top:10px;">
                    Lưu xong → lịch sẽ được dùng để bệnh nhân đặt lịch (chỉ hiện giờ đã mở).
                </div>
            </form>
        </div>
    </div>

</div>

<style>
.slotpick {
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 10px 12px;
    min-width: 130px;
    font-weight: 900;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    user-select: none;
    background: #fff;
}

.slotpick input {
    width: 16px;
    height: 16px;
}

.slotpick.on {
    background: var(--primary-soft);
    border-color: rgba(14, 165, 164, .35);
}
</style>

<script>
const ALL_SLOTS = <?= json_encode($allSlots ?? []) ?>;
let ACTIVE = <?= json_encode($activeSlots ?? []) ?>;

function renderSlots(active) {
    const box = document.getElementById('slotsBox');
    box.innerHTML = '';

    ALL_SLOTS.forEach(s => {
        const label = document.createElement('label');
        label.className = 'slotpick' + (active.includes(s) ? ' on' : '');
        label.innerHTML = `
      <input type="checkbox" name="slots[]" value="${s}" ${active.includes(s) ? 'checked' : ''}>
      <span>${s}</span>
    `;

        label.querySelector('input').addEventListener('change', (e) => {
            if (e.target.checked) label.classList.add('on');
            else label.classList.remove('on');
        });

        box.appendChild(label);
    });
}

function syncHidden() {
    const did = document.getElementById('doctor_id').value;
    const ngay = document.getElementById('ngay').value;
    document.getElementById('f_doctor_id').value = did;
    document.getElementById('f_ngay').value = ngay;

    const link =
        `index.php?c=adminSchedule&a=index&doctor_id=${encodeURIComponent(did)}&ngay=${encodeURIComponent(ngay)}`;
    document.getElementById('shareLink').href = link;
}

function checkAll(on) {
    document.querySelectorAll('#slotsBox input[type="checkbox"]').forEach(cb => {
        cb.checked = on;
        cb.dispatchEvent(new Event('change'));
    });
}

async function loadSlots() {
    syncHidden();

    const did = document.getElementById('doctor_id').value;
    const ngay = document.getElementById('ngay').value;

    // gọi endpoint JSON để lấy activeSlots theo bác sĩ + ngày
    const url =
        `index.php?c=adminSchedule&a=slots&doctor_id=${encodeURIComponent(did)}&ngay=${encodeURIComponent(ngay)}`;

    try {
        const res = await fetch(url);
        const data = await res.json();
        ACTIVE = data.active || [];
    } catch (e) {
        // nếu endpoint chưa có, fallback giữ ACTIVE cũ
    }

    renderSlots(ACTIVE);
}

document.addEventListener('DOMContentLoaded', () => {
    syncHidden();
    renderSlots(ACTIVE);
});
</script>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>