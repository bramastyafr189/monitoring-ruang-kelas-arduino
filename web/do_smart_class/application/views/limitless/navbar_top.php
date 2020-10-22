<div class="navbar-top">
    <!-- Main navbar -->
    <div class="navbar navbar-inverse  navbar-fixed-top">
        <?php $this->load->view('limitless/navbar_top_isi');?>
    </div>
    <!-- /main navbar -->

</div>

<script>
    function refresh_karyawan(){
            $('#navbar_karyawan_isi').html('sedang memuat..');
            $('#navbar_karyawan_isi').load('transpos/karyawan_outlet');
    }
				function refresh_message(){
		$('#navbar_inbox_list').html('sedang memuat..');
		$('#navbar_inbox_list').load('system_nakamura/inbox_list');
		}
	

    </script>