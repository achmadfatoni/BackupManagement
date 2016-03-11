@include('elements.side-menu-parent-item', [
'folder' => 'backup-management',
'menu' => 'Backup Management',
'menuIcon' => 'fa-archive',
'children' => [ [
        'page' => 'list',
        'url' => 'list/all',
        'menu' => 'View All Backups',
    ], [
        'page' => 'start-backup',
        'url' => 'start-backup',
        'menu' => 'Start Backup',
    ], [
        'page' => 'view',
        'menu' => 'Backup Details',
    ]
]])
