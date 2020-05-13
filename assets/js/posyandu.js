function goBack() {
	window.history.back();
}

$("#deleteModal").on("show.bs.modal", function (event) {
	var button = $(event.relatedTarget);
	var id = button.data("id");
	var act = button.data("act");
	$("#idhapus").attr("value", id);
	$("#deleteForm").attr("action", act);
});

$(document).ready(function () {
	$("#beritaAcara").DataTable({
		order: [[0, "desc"]],
		// columnDefs: [{ width: "200px", targets: 3 }],
	});
});
$(document).ready(function () {
	$("#tabelPengukuran").DataTable({
		paging: false,
	});
});
$(document).ready(function () {
	$("#tabelStatistik").DataTable({
		paging: false,
		searching: false,
		order: [[1, "asc"]],
	});
});
$(document).ready(function () {
	$("#provinsiTable").DataTable({
		paging: true,
		searching: true,
		info: false,
	});
	$("#kabupatenTable").DataTable({
		paging: true,
		searching: true,
		info: false,
	});
	$("#kecamatanTable").DataTable({
		paging: true,
		searching: true,
		info: false,
	});
	$("#desaTable").DataTable({
		paging: true,
		searching: true,
		info: false,
	});
	$("#userTable").DataTable({
		paging: true,
		searching: true,
		info: true,
	});
	$("#bgmTable").DataTable({
		ordering: false,
		paging: false,
		searching: true,
		info: true,
	});
	$("listOverviewTable").DataTable({
		ordering: false,
		paging: false,
		info: true,
	});
});
