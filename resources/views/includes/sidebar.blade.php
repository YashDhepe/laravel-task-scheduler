<div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
    <h3 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"> </h3>
    <div class="list-group rounded-0">
        <a href="{{ route('dashboard') }}"
            class="list-group-item list-group-item-action border-0 d-flex align-items-center {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <div style="padding-left: 10%">
                <span class="bi bi-border-all"></span>
                <span class="ml-2">Dashboard</span>
            </div>
        </a>

        <button
            class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#sale-collapse">
            <i class="fa fa-users"></i>
            <div>
                <span class="bi bi-cart-dash"></span>
                <span class="ml-2">User Management</span>
            </div>
            <span class="bi bi-chevron-down small"></span>
        </button>
        <div class="collapse {{ in_array(Route::currentRouteName(), ['users.index', 'users.deleted']) ? 'show' : '' }}"
            id="sale-collapse" data-parent="#sidebar">
            <div class="list-group">
                <a href="{{ route('users.index') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
                    Add & View Users
                </a>
                {{-- <a href="{{ route('users.deleted') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'users.deleted' ? 'active' : '' }}">
                    Deleted Users</a> --}}
            </div>
        </div>

        <button
            class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#purchase-collapse">
            <i class="fas fa-tasks"></i>
            <div>
                <span class="bi bi-cart-plus"></span>
                <span class="ml-2">Task Management</span>
            </div>
            <span class="bi bi-chevron-down small"></span>
        </button>
        <div class="collapse {{ in_array(Route::currentRouteName(), ['tasks.index', 'tasks.deleted']) ? 'show' : '' }}"
            id="purchase-collapse" data-parent="#sidebar">
            <div class="list-group">
                <a href="{{ route('tasks.index') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'tasks.index' ? 'active' : '' }}">
                    <span>Add & View Tasks</span>
                </a>
                <a href="{{ route('tasks.deleted') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'tasks.deleted' ? 'active' : '' }}">Deleted
                    Tasks</a>
            </div>
        </div>



        <button
            class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#assigned-tasks-collapse">
            <i class="fa-solid fa-users-gear"></i>
            <div>
                <span class="bi bi-cart-plus"></span>
                <span class="ml-2">Assigned Tasks &nbsp;&nbsp;&nbsp;</span>
            </div>
            <span class="bi bi-chevron-down small"></span>
        </button>
        <div class="collapse {{ in_array(Route::currentRouteName(), ['tasks.assign.my-tasks','tasks.assign.index', 'tasks.assign.to-do', 'tasks.assign.in-progress', 'tasks.assign.ready-for-qa', 'tasks.assign.ready-for-production']) ? 'show' : '' }}"
            id="assigned-tasks-collapse" data-parent="#sidebar">
            <div class="list-group">
                <a href="{{ route('tasks.assign.my-tasks') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'tasks.assign.my-tasks' ? 'active' : '' }}">
                    <span>My Tasks</span>
                </a>
                <a href="{{ route('tasks.assign.index') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'tasks.assign.index' ? 'active' : '' }}">
                    <span>All Assigned Tasks</span>
                </a>
                <a href="{{ route('tasks.assign.to-do') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'tasks.assign.to-do' ? 'active' : '' }}">
                    <span>Todo Tasks</span>
                </a>
                <a href="{{ route('tasks.assign.in-progress') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'tasks.assign.in-progress' ? 'active' : '' }}">
                    <span>In-Progress Tasks</span>
                </a>
                <a href="{{ route('tasks.assign.ready-for-qa') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'tasks.assign.ready-for-qa' ? 'active' : '' }}">
                    <span>Ready for QA Tasks</span>
                </a>
                <a href="{{ route('tasks.assign.ready-for-production') }}"
                    class="list-group-item list-group-item-action border-0 pl-5 {{ Route::currentRouteName() == 'tasks.assign.ready-for-production' ? 'active' : '' }}">
                    <span>Ready for Production Tasks</span>
                </a>
            </div>
        </div>
    </div>
</div>
