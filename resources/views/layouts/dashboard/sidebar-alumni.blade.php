<li>
    <a href="{{ route('share-jobs.index') }}"
        class="@if (request()->routeIs(['share-jobs.*'])) sidebar-active @else sidebar @endif">
        <svg class="sidebar-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M5 4a2 2 0 0 0-2 2v1h10.968l-1.9-2.28A2 2 0 0 0 10.532 4H5ZM3 19V9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm11.707-7.707a1 1 0 0 0-1.414 1.414l.293.293H8a1 1 0 1 0 0 2h5.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2Z"
                clip-rule="evenodd" />
        </svg>
        <span class="ms-3">Sharing Jobs</span>
    </a>
</li>
