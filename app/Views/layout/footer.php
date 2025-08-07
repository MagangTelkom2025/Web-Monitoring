<footer class="bg-[#fcf8f8] border-t border-[#f3e7e8] px-10 py-6 mt-auto">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4 text-[#1b0e0e]">
            <div class="size-4">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H42V17.3333V30.6667H24V44H6V30.6667V17.3333H24V4Z" fill="currentColor"></path>
                </svg>
            </div>
            <p class="text-[#994d51] text-sm">&copy; <?= date('Y') ?> Telkom Monitor. All rights reserved.</p>
        </div>
        <div class="flex items-center gap-6">
            <a href="#" class="text-[#994d51] text-sm hover:text-[#1b0e0e] transition-colors">Privacy Policy</a>
            <a href="#" class="text-[#994d51] text-sm hover:text-[#1b0e0e] transition-colors">Terms of Service</a>
            <a href="#" class="text-[#994d51] text-sm hover:text-[#1b0e0e] transition-colors">Support</a>
        </div>
    </div>
</footer>
</div>

<!-- Local Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

<?= $this->renderSection('scripts') ?? '' ?>
</div>
</body>

</html>