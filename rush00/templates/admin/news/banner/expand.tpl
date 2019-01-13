<form action="admin/banner/stats/{ID}" method="post">
<div class="oEditItem oT2">
<table><tbody>
    <tr><td colspan="2"><h3>Banner statistics</h3></td></tr>
    <tr>
        <td><span>From:</span></td>
        <td>
			<div class="inputText"><i><b><input type="text" name="from" class="fromDate" size="10"/></b></i></div>
            <!-- BEGIN error_from --><div class="error">{error_from.MESSAGE}</div><!-- END error_from -->
        </td>
    </tr>
    <tr>
        <td><span>To:</span></td>
        <td>
            <div class="inputText"><i><b><input type="text" name="to" class="toDate" size="10"/></b></i></div>
            <!-- BEGIN error_to --><div class="error">{error_to.MESSAGE}</div><!-- END error_to -->
        </td>
    </tr>
    <tr>
        <td class="empty">&nbsp;</td>
        <td><div class="oActButtons">
            <a href="javascript:;" class="save">Get stats</a>
        </div></td>
    </tr>
</tbody></table>
</div>
<!-- BEGIN stats -->
<div class="bannersStats oEditor">
    <table>
    <thead><tr>
        <td>Clicks</td>
        <td>Views</td>
    </tr></thead>
    <tbody>
        <tr>
            <td>{stats.CLICKS}</td>
            <td>{stats.VIEWS}</td>
        </tr>
    </tbody>
    </table>
</div>
<!-- END stats -->
</form>