<div class="bg-surface-card rounded-xl shadow-sm border border-border-subtle h-full">
    <div class="p-6 border-b border-border-subtle">
        <h3 class="text-lg font-semibold text-text-primary">System Status</h3>
    </div>
    
    <div class="p-6 space-y-6">
        <!-- CPU Usage -->
        <div>
            <div class="flex justify-between mb-2">
                <span class="text-sm font-medium text-text-secondary">CPU Usage</span>
                <span class="text-sm font-bold text-text-primary">45%</span>
            </div>
            <div class="w-full bg-surface-muted rounded-full h-2.5">
                <div class="bg-accent-secondary h-2.5 rounded-full" style="width: 45%"></div>
            </div>
        </div>

        <!-- Memory Usage -->
        <div>
            <div class="flex justify-between mb-2">
                <span class="text-sm font-medium text-text-secondary">Memory Usage</span>
                <span class="text-sm font-bold text-text-primary">60%</span>
            </div>
            <div class="w-full bg-surface-muted rounded-full h-2.5">
                <div class="bg-accent-primary h-2.5 rounded-full" style="width: 60%"></div>
            </div>
        </div>

        <!-- Disk Usage -->
        <div>
            <div class="flex justify-between mb-2">
                <span class="text-sm font-medium text-text-secondary">Disk Usage</span>
                <span class="text-sm font-bold text-text-primary">28%</span>
            </div>
            <div class="w-full bg-surface-muted rounded-full h-2.5">
                <div class="bg-success h-2.5 rounded-full" style="width: 28%"></div>
            </div>
        </div>
        
         <div class="pt-4 mt-4 border-t border-border-subtle">
            <div class="flex items-center space-x-2">
                 <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-success"></span>
                </span>
                <span class="text-sm font-medium text-success">All Systems Operational</span>
            </div>
         </div>
    </div>
</div>
