<!-- File permissions status -->
<div class="form-group alert alert-{{ $filePermissions?'success':'danger' }} in-installer">

    <i class="fa fa-{!! $filePermissions?'check':'warning' !!}"></i>

    <label><i class="fa fa-lock"> </i> File Permissions </label>

    <div class="explain">
        <code>storage/</code> folder is {{ $filePermissions?'writeable':'not writeable' }}
    </div>

</div>

<!-- Database Connection status -->
<div class="form-group alert alert-{{ $dbStatus?'success':'danger' }} in-installer">

    <i class="fa fa-{!! $dbStatus?'check':'warning' !!}"></i>

    <label><i class="fa fa-database"> </i> Database status </label>
    <div>
        {{ $dbStatus?'Connected':'Not connected' }}
    </div>

</div>


<!-- Database Table status -->
<div class="form-group alert alert-{{ $dbTables?'success':'danger' }} in-installer">

    <i class="fa fa-{!! $dbTables?'check':'warning' !!}"></i>

    <label><i class="fa fa-database"> </i> Database tables </label>
    <div>
        {{ $dbTables?'Installed':'Not migrated' }}
    </div>

</div>

<!-- There Admin status -->
<div class="form-group alert alert-{{ $thereAdmins?'success':'danger' }} in-installer">

    <i class="fa fa-{!! $thereAdmins?'check':'warning' !!}"></i>

    <label><i class="fa fa-database"> </i> There admin users </label>
    <div>
        {{ $thereAdmins?'Yes':'No' }}
    </div>

</div>