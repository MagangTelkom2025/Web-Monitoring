<html>

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
        rel="stylesheet"
        as="style"
        onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Manrope%3Awght%40400%3B500%3B700%3B800&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900" />

    <title>Monitor Ticket</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>

<body>
    <div class="relative flex size-full min-h-screen flex-col bg-[#fcf8f8] group/design-root overflow-x-hidden" style='font-family: Manrope, "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f3e7e8] px-10 py-3">
                <div class="flex items-center gap-4 text-[#1b0e0e]">
                    <div class="size-4">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H42V17.3333V30.6667H24V44H6V30.6667V17.3333H24V4Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h2 class="text-[#1b0e0e] text-lg font-bold leading-tight tracking-[-0.015em]">Ticket Dashboard</h2>
                </div>
            </header>
            <div class="flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col w-full max-w-md py-5 flex-1">
                    <div class="flex justify-center w-full bg-[#fcf8f8] p-4">
                        <div class="w-64 h-64 overflow-hidden bg-[#fcf8f8] rounded-lg flex items-center justify-center">
                            <div
                                class="w-full h-full bg-center bg-no-repeat bg-cover rounded-lg"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDTZNae0eHS_aoZmr5MSBUu0imQGv74ohtz7mQ44aWsd1FENKFCB3CIGES9WlrK9qloDXPDB349EPa_hS9jVj50KuFf1Vmdqs67GTlXXUGzHXRJROaOZsVrqsQPkXIJVdZZ4-mFk7BOtUjsnIzdnGEDUp5qRdKVbint6ZSYxjONPbDMICj4uCSK-RlV99t_tXDu4a-lK3rVmMG01csGYMHOcK7V4qzBRNOw4bV_q598vyW7bVAW7ERczBJ0u4cQWRfmCFnxIXaVgwg");'></div>
                        </div>
                    </div>
                    <h2 class="text-[#1b0e0e] tracking-light text-[28px] font-bold leading-tight px-4 text-center pb-3 pt-5">Login</h2>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto max-w-sm mb-4" role="alert">
                        <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('auth/authenticate') ?>" method="post" class="w-full max-w-sm mx-auto">
                        <?= csrf_field() ?>
                        <div class="flex flex-col items-center gap-4 py-3">
                            <label class="flex flex-col w-full">
                                <p class="text-[#1b0e0e] text-base font-medium leading-normal pb-2">Username</p>
                                <input
                                    name="username"
                                    placeholder="Enter your username"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b0e0e] focus:outline-0 focus:ring-0 border border-[#e7d0d1] bg-[#fcf8f8] focus:border-[#e7d0d1] h-14 placeholder:text-[#994d51] p-[15px] text-base font-normal leading-normal"
                                    value="<?= old('username') ?>" />
                            </label>
                        </div>
                        <div class="flex flex-col items-center gap-4 py-3">
                            <label class="flex flex-col w-full">
                                <p class="text-[#1b0e0e] text-base font-medium leading-normal pb-2" >Password</p>
                                <input
                                    type="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b0e0e] focus:outline-0 focus:ring-0 border border-[#e7d0d1] bg-[#fcf8f8] focus:border-[#e7d0d1] h-14 placeholder:text-[#994d51] p-[15px] text-base font-normal leading-normal"
                                    value="" />
                            </label>
                        </div>
                        <div class="flex justify-center py-3">
                            <button
                                type="submit"
                                class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#ea2a33] text-[#fcf8f8] text-sm font-bold leading-normal tracking-[0.015em]">
                                <span class="truncate">Login</span>
                            </button>
                        </div>
                    </form>
                    <p class="text-[#994d51] text-sm text-center mt-2">Forgot your password? <a href="<?= base_url('auth/forgot_password') ?>" class="text-[#ea2a33] font-medium">Reset it here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>