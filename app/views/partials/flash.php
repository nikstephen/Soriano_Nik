<?php if (!empty($success)): ?>
    <div class="alert alert-success message-center">
        <?= $success ?>
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger message-center">
        <?= $error ?>
    </div>
<?php endif; ?>

<style>
.message-center {
    text-align: center;
    font-style: italic;
    width: 400px;              /* bigger width */
    min-width: 300px;
    margin: 0 auto 20px auto;
    padding: 12px 25px;
    border-radius: 8px;
    opacity: 0;               /* start invisible */
    transform: translateY(-20px); /* slide from top */
    transition: opacity 0.6s ease, transform 0.6s ease;
    position: relative;       /* allow smooth movement */
    z-index: 1000;
}

.alert-success {
    color: #b1e0bcff;
    background-color: #155724;
    border: 1px solid #0b992cff;
}

.alert-danger {
    color: #d9bdc0ff;
    background-color: #c51423ff;
    border: 1px solid #d04755ff;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messages = document.querySelectorAll('.message-center');

    messages.forEach(msg => {
        // Slide down + fade in
        setTimeout(() => {
            msg.style.opacity = 1;
            msg.style.transform = 'translateY(0)';
        }, 100);

        // Keep visible for 3 seconds
        setTimeout(() => {
            msg.style.opacity = 0;
            msg.style.transform = 'translateY(-20px)';
        }, 3100);

        // Remove from DOM after fade-out
        setTimeout(() => {
            msg.remove();
        }, 4000);
    });
});
</script>
