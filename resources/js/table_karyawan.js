$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

const table = $("#karyawan").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "/karyawan/data-karyawan",
        type: "GET",
    },
    columns: [
        {
            data: "id",
            render: function (data, type, row, meta) {
                return meta.row + 1;
            },
        },
        {
            data: "foto",
            render: function (data, type, row) {
                if (!data) {
                    return '<div class="text-center"><i class="fas fa-user-circle fa-3x text-secondary"></i></div>';
                }
                const url = `/karyawan/foto-karyawan/${data}?v=${new Date().getTime()}`;
                return `
                    <div class="text-center">
                        <img src="${url}" class="rounded-circle border" width="60" height="60"
                        style="object-fit: cover"
                        onerror="this.onerror=null;this.src='data:image/svg+xml...';this.alt='Gambar tidak ditemukan'" 
                        alt="Foto ${row.name}">
                    </div>
                `;
            },
        },
        { data: "name" },
        { data: "jabatan" },
        { data: "jenis_kelamin" },
        { data: "alamat" },
        {
            data: "actions",
        },
    ],
});

// Tombol Edit
$(document).on("click", ".btn-edit", function () {
    const id = $(this).data("id");

    $.ajax({
        url: `/karyawan/edit-karyawan/${id}`,
        type: "GET",
        success: function (res) {
            $("#employee_id").val(res.id);
            $("#name").val(res.name);
            $("#jabatan").val(res.jabatan);
            $("#jenis_kelamin").val(res.jenis_kelamin);
            $("#alamat").val(res.alamat);
            $("#foto").val("");

            $("#postAddEmployee").attr(
                "action",
                `/karyawan/update-karyawan/${res.id}`
            );
            $("#modalTitleText").text("Edit Employee");
            $("#submitEmployee").text("Update Employee");
            $("#addEmployee").modal("show");
        },
        error: function () {
            alert("Gagal mengambil data.");
        },
    });
});

// Reset form saat modal ditutup
$("#addEmployee").on("hidden.bs.modal", function () {
    $("#postAddEmployee")[0].reset();
    $("#postAddEmployee").attr(
        "action",
        "{{ route('karyawan.insertKaryawan') }}"
    );
    $("#modalTitleText").text("Add Employee");
    $("#submitEmployee").text("Save Employee");
    $("#employee_id").val("");
});
