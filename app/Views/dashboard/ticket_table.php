<h3 class="text-[#1b0e0e] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Detailed Ticket Data</h3>
<div class="px-4 py-3 @container">
    <div class="flex overflow-hidden rounded-lg border border-[#e7d0d1] bg-[#fcf8f8]">
        <table class="flex-1">
            <thead>
                <tr class="bg-[#fcf8f8]">
                    <th class="px-4 py-3 text-left text-[#1b0e0e] w-[400px] text-sm font-medium leading-normal">Ticket ID</th>
                    <th class="px-4 py-3 text-left text-[#1b0e0e] w-60 text-sm font-medium leading-normal">Priority</th>
                    <th class="px-4 py-3 text-left text-[#1b0e0e] w-60 text-sm font-medium leading-normal">Status</th>
                    <th class="px-4 py-3 text-left text-[#1b0e0e] w-60 text-sm font-medium leading-normal">Category</th>
                    <th class="px-4 py-3 text-left text-[#1b0e0e] w-[400px] text-sm font-medium leading-normal">Date Created</th>
                    <th class="px-4 py-3 text-left text-[#1b0e0e] w-[400px] text-sm font-medium leading-normal">Date Resolved</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($tickets) && !empty($tickets)): ?>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr class="border-t border-t-[#e7d0d1]">
                            <td class="h-[72px] px-4 py-2 w-[400px] text-[#1b0e0e] text-sm font-normal leading-normal"><?= $ticket['id'] ?></td>
                            <td class="h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                                <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f3e7e8] text-[#1b0e0e] text-sm font-medium leading-normal w-full">
                                    <span class="truncate"><?= $ticket['priority'] ?></span>
                                </button>
                            </td>
                            <td class="h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                                <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f3e7e8] text-[#1b0e0e] text-sm font-medium leading-normal w-full">
                                    <span class="truncate"><?= $ticket['status'] ?></span>
                                </button>
                            </td>
                            <td class="h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                                <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f3e7e8] text-[#1b0e0e] text-sm font-medium leading-normal w-full">
                                    <span class="truncate"><?= $ticket['category'] ?></span>
                                </button>
                            </td>
                            <td class="h-[72px] px-4 py-2 w-[400px] text-[#994d51] text-sm font-normal leading-normal"><?= $ticket['created_date'] ?></td>
                            <td class="h-[72px] px-4 py-2 w-[400px] text-[#994d51] text-sm font-normal leading-normal"><?= $ticket['resolved_date'] ?? 'N/A' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Sample data if no tickets available -->
                    <tr class="border-t border-t-[#e7d0d1]">
                        <td class="h-[72px] px-4 py-2 w-[400px] text-[#1b0e0e] text-sm font-normal leading-normal">TKT001</td>
                        <td class="h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f3e7e8] text-[#1b0e0e] text-sm font-medium leading-normal w-full">
                                <span class="truncate">High</span>
                            </button>
                        </td>
                        <td class="h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f3e7e8] text-[#1b0e0e] text-sm font-medium leading-normal w-full">
                                <span class="truncate">Open</span>
                            </button>
                        </td>
                        <td class="h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#f3e7e8] text-[#1b0e0e] text-sm font-medium leading-normal w-full">
                                <span class="truncate">Technical</span>
                            </button>
                        </td>
                        <td class="h-[72px] px-4 py-2 w-[400px] text-[#994d51] text-sm font-normal leading-normal">2024-07-01</td>
                        <td class="h-[72px] px-4 py-2 w-[400px] text-[#994d51] text-sm font-normal leading-normal">N/A</td>
                    </tr>
                    <!-- More sample rows... -->
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>