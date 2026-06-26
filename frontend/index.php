<?php
require_once 'data.php';

$view = isset($_GET['view']) ? $_GET['view'] : 'dashboard';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$contractor = null;
if ($id && isset($contractors[$id])) {
    $contractor = $contractors[$id];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trade Passport Engine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Base styles for the 'dark navy text' and 'slate grey borders' */
        body {
            color: #0f172a; /* Slate 900 */
            background-color: #f8fafc; /* Slate 50 */
        }
        .border-slate {
            border-color: #cbd5e1; /* Slate 300 */
        }
    </style>
</head>
<body class="antialiased min-h-screen">
    <nav class="bg-white border-b border-slate px-8 py-5 mb-8 flex items-center justify-between shadow-sm">
        <div class="text-xl font-bold tracking-tight text-slate-800">Trade Passport Engine</div>
        <?php if ($view !== 'dashboard'): ?>
            <a href="?view=dashboard" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">&larr; Back to Dashboard</a>
        <?php endif; ?>
    </nav>

    <main class="max-w-5xl mx-auto px-8">
        <?php if ($view === 'dashboard'): ?>
            <!-- Dashboard View -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold tracking-tight">Active Contractors</h1>
                <p class="text-slate-500 mt-1">Select a contractor to view their Trade Passport metrics.</p>
            </div>
            
            <div class="bg-white border border-slate rounded-lg overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate text-sm text-slate-500 uppercase tracking-wider">
                            <th class="py-4 px-6 font-semibold">Contractor</th>
                            <th class="py-4 px-6 font-semibold">Accounts Receivable</th>
                            <th class="py-4 px-6 font-semibold">Trade Passport Health</th>
                            <th class="py-4 px-6 font-semibold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate">
                        <?php foreach ($contractors as $c): ?>
                            <?php 
                                $badgeColor = '';
                                if ($c['health_status'] === 'Prime') $badgeColor = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                                else if ($c['health_status'] === 'Amber') $badgeColor = 'bg-amber-100 text-amber-800 border-amber-200';
                                else if ($c['health_status'] === 'Toxic') $badgeColor = 'bg-rose-100 text-rose-800 border-rose-200';
                            ?>
                            <tr class="hover:bg-slate-50 transition-colors cursor-pointer group" onclick="window.location.href='?view=passport&id=<?= $c['id'] ?>'">
                                <td class="py-5 px-6 font-medium"><?= htmlspecialchars($c['name']) ?></td>
                                <td class="py-5 px-6 text-slate-600">RM <?= htmlspecialchars($c['owe_amount']) ?></td>
                                <td class="py-5 px-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border <?= $badgeColor ?>">
                                        <?= htmlspecialchars($c['health_status']) ?> (<?= htmlspecialchars($c['health_score']) ?>%)
                                    </span>
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <span class="text-blue-600 group-hover:text-blue-800 font-medium text-sm transition-colors">View Passport &rarr;</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($view === 'passport' && $contractor): ?>
            <!-- Passport View -->
            
            <!-- Loading State -->
            <div id="loading-state" class="flex flex-col items-center justify-center py-32">
                <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-blue-600 mb-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <div id="loading-text" class="text-lg font-medium text-slate-600 transition-opacity duration-300">Syncing LHDN e-Invoice API...</div>
            </div>

            <!-- Loaded State -->
            <div id="loaded-state" class="hidden space-y-8 animate-fade-in pb-12">
                
                <div class="flex justify-between items-end mb-4 border-b border-slate pb-6">
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight text-slate-900"><?= htmlspecialchars($contractor['name']) ?></h1>
                        <p class="text-slate-500 mt-2 text-lg">Accounts Receivable: <span class="font-medium text-slate-700">RM <?= htmlspecialchars($contractor['owe_amount']) ?></span></p>
                    </div>
                    <?php 
                        $badgeColor = '';
                        if ($contractor['health_status'] === 'Prime') $badgeColor = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                        else if ($contractor['health_status'] === 'Amber') $badgeColor = 'bg-amber-100 text-amber-800 border-amber-200';
                        else if ($contractor['health_status'] === 'Toxic') $badgeColor = 'bg-rose-100 text-rose-800 border-rose-200';
                    ?>
                    <div class="text-right">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold border <?= $badgeColor ?>">
                            <?= htmlspecialchars($contractor['health_status']) ?> Passport (<?= htmlspecialchars($contractor['health_score']) ?>%)
                        </span>
                    </div>
                </div>

                <!-- Trade Passport Metrics Card -->
                <div class="bg-white border border-slate rounded-lg p-8 shadow-sm">
                    <h2 class="text-sm font-bold text-slate-400 border-b border-slate pb-4 mb-6 uppercase tracking-widest">Trade Passport Metrics</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div>
                            <div class="text-sm font-medium text-slate-500 mb-1">Transaction Frequency</div>
                            <div class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($contractor['frequency']) ?></div>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-slate-500 mb-1">Payment Habits</div>
                            <div class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($contractor['payment_days']) ?> Days</div>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-slate-500 mb-1">Years of Cooperation</div>
                            <div class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($contractor['coop_years']) ?> Years</div>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-slate-500 mb-1">Amount Trend</div>
                            <div class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($contractor['trend']) ?></div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Delivery / Action Section -->
                    <div class="bg-white border border-slate rounded-lg p-8 shadow-sm flex flex-col">
                        <h2 class="text-lg font-bold text-slate-900 border-b border-slate pb-4 mb-6">New Delivery Order</h2>
                        
                        <div class="flex-grow">
                        <?php if ($contractor['health_status'] === 'Prime'): ?>
                            <p class="text-slate-600 mb-6">This contractor has an excellent payment history. Frictionless processing enabled.</p>
                        <?php elseif ($contractor['health_status'] === 'Amber'): ?>
                            <div class="bg-amber-50 border border-amber-200 text-amber-900 px-4 py-4 rounded mb-6 text-sm flex items-start">
                                <svg class="h-5 w-5 text-amber-600 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <span><strong>Late Payer History:</strong> This contractor has a history of delayed payments. Proceed with standard caution.</span>
                            </div>
                        <?php elseif ($contractor['health_status'] === 'Toxic'): ?>
                            <div class="bg-rose-50 border border-rose-200 text-rose-900 px-4 py-4 rounded mb-6 text-sm flex items-start">
                                <svg class="h-5 w-5 text-rose-600 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <span><strong>High Default Risk:</strong> This contractor exhibits severe late payment behaviors and declining trends.</span>
                            </div>
                            <label class="flex items-start space-x-3 mb-6 cursor-pointer group">
                                <input type="checkbox" id="toxic-confirm" class="w-5 h-5 mt-0.5 text-slate-900 rounded border-slate-300 focus:ring-slate-900 cursor-pointer">
                                <span class="text-sm text-slate-600 group-hover:text-slate-800 select-none leading-tight">I acknowledge the high risk of default and authorize this delivery order despite the Toxic rating.</span>
                            </label>
                        <?php endif; ?>
                        </div>

                        <?php if ($contractor['health_status'] === 'Toxic'): ?>
                            <button id="toxic-btn" disabled class="mt-auto w-full bg-slate-200 text-slate-400 font-bold py-3.5 px-4 rounded cursor-not-allowed transition-all duration-200 border border-transparent">
                                Print Delivery Order
                            </button>
                        <?php else: ?>
                            <button class="mt-auto w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 border border-transparent shadow-sm">
                                Print Delivery Order
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- The CapBay Bridge -->
                    <div class="bg-slate-50 border border-slate rounded-lg p-8 shadow-sm flex flex-col justify-center items-center text-center">
                        <div class="mb-8">
                            <div class="h-16 w-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Institutional Financing</h3>
                            <p class="text-slate-500 max-w-xs mx-auto">Need immediate cash flow for this invoice? Submit directly to our financing partners.</p>
                        </div>
                        <button id="capbay-btn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 shadow-sm">
                            Submit AR to CapBay
                        </button>
                    </div>
                </div>

            </div>

            <!-- CapBay Success Modal -->
            <div id="capbay-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center hidden opacity-0 transition-opacity duration-300 z-50">
                <div class="bg-white rounded-xl p-8 max-w-md w-full shadow-2xl transform scale-95 transition-all duration-300 mx-4 border border-slate">
                    <div class="flex justify-center mb-6">
                        <div class="bg-emerald-100 rounded-full p-4 border border-emerald-200 shadow-sm">
                            <svg class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-center text-slate-900 mb-3">Submission Successful</h3>
                    <p class="text-slate-600 text-center mb-8 leading-relaxed">Accounts Receivable and Trade Passport successfully submitted to CapBay for institutional financing.</p>
                    <button id="close-modal-btn" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2">
                        Return to Dashboard
                    </button>
                </div>
            </div>

            <style>
                .animate-fade-in {
                    animation: fadeIn 0.5s ease-out forwards;
                }
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(15px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            </style>

            <script>
                // Simulate Loading Sequence
                const loadingTextEl = document.getElementById('loading-text');
                const loadingStateEl = document.getElementById('loading-state');
                const loadedStateEl = document.getElementById('loaded-state');
                
                const sequence = [
                    "Verifying E-Delivery Orders...",
                    "Fetching Bank Statements...",
                    "Finalizing Passport Score..."
                ];
                
                let seqIndex = 0;
                
                // Fade out/in effect for text
                const intervalId = setInterval(() => {
                    if (seqIndex < sequence.length) {
                        loadingTextEl.style.opacity = 0;
                        setTimeout(() => {
                            loadingTextEl.textContent = sequence[seqIndex];
                            loadingTextEl.style.opacity = 1;
                            seqIndex++;
                        }, 200);
                    }
                }, 900);

                setTimeout(() => {
                    clearInterval(intervalId);
                    loadingStateEl.classList.add('hidden');
                    loadedStateEl.classList.remove('hidden');
                }, 3200);

                // Toxic Contractor Logic
                const toxicConfirm = document.getElementById('toxic-confirm');
                const toxicBtn = document.getElementById('toxic-btn');
                
                if (toxicConfirm && toxicBtn) {
                    toxicConfirm.addEventListener('change', (e) => {
                        if (e.target.checked) {
                            toxicBtn.disabled = false;
                            toxicBtn.classList.remove('bg-slate-200', 'text-slate-400', 'cursor-not-allowed', 'border-transparent');
                            toxicBtn.classList.add('bg-slate-900', 'hover:bg-slate-800', 'text-white', 'shadow-sm');
                        } else {
                            toxicBtn.disabled = true;
                            toxicBtn.classList.add('bg-slate-200', 'text-slate-400', 'cursor-not-allowed', 'border-transparent');
                            toxicBtn.classList.remove('bg-slate-900', 'hover:bg-slate-800', 'text-white', 'shadow-sm');
                        }
                    });
                }

                // CapBay Modal Logic
                const capbayBtn = document.getElementById('capbay-btn');
                const capbayModal = document.getElementById('capbay-modal');
                const closeModalBtn = document.getElementById('close-modal-btn');

                if (capbayBtn && capbayModal && closeModalBtn) {
                    capbayBtn.addEventListener('click', () => {
                        capbayModal.classList.remove('hidden');
                        // Trigger reflow to apply transition
                        void capbayModal.offsetWidth;
                        capbayModal.classList.remove('opacity-0');
                        capbayModal.querySelector('.transform').classList.remove('scale-95');
                        capbayModal.querySelector('.transform').classList.add('scale-100');
                    });

                    closeModalBtn.addEventListener('click', () => {
                        capbayModal.classList.add('opacity-0');
                        capbayModal.querySelector('.transform').classList.remove('scale-100');
                        capbayModal.querySelector('.transform').classList.add('scale-95');
                        
                        setTimeout(() => {
                            capbayModal.classList.add('hidden');
                        }, 300);
                    });
                }
            </script>
        <?php else: ?>
            <div class="py-24 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-medium text-slate-900">Contractor not found</h3>
                <p class="mt-1 text-slate-500">The requested Trade Passport could not be located.</p>
                <div class="mt-6">
                    <a href="?view=dashboard" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        &larr; Return to Dashboard
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
