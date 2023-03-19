$(function () {
    const ADMIN_URL = $("#js-adminurl").val();
    $("#DataList #ListTable thead tr").append('<th class="bca-table-listup__thead-th">勤怠一覧</th>');
    $("#DataList #ListTable tbody tr").each(function(){
        let userid = $(this).children("td:nth-child(1)").text();
        $(this).append('<td class="bca-table-listup__tbody-td"><a href="'+ ADMIN_URL +'/attendance/attendancelist/index/'+ userid +'" title="一覧" class=" bca-btn-icon" data-bca-btn-type="th-list" data-bca-btn-size="lg"></a></td>');
    });
});
