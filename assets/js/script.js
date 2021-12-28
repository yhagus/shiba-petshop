$(document).ready(function() {
    let slider = $("#slider");
    let thumb = $("#thumb");
    let slidesPerPage = 4; //globaly define number of elements per page
    let syncedSecondary = true;
    slider.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: false,
        autoplay: false,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200
    }).on('changed.owl.carousel', syncPosition);
    thumb
    .on('initialized.owl.carousel', function() {
        thumb.find(".owl-item").eq(0).addClass("current");
    })
    .owlCarousel({
        items: slidesPerPage,
        dots: false,
        nav: true,
        item: 4,
        smartSpeed: 200,
        slideSpeed: 500,
        slideBy: slidesPerPage,
        navText: ['<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
        responsiveRefreshRate: 100
    }).on('changed.owl.carousel', syncPosition2);
    function syncPosition(el) {
        let count = el.item.count - 1;
        let current = Math.round(el.item.index - (el.item.count / 2) - .5);
        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }
        thumb
        .find(".owl-item")
        .removeClass("current")
        .eq(current)
        .addClass("current");
        let onscreen = thumb.find('.owl-item.active').length - 1;
        let start = thumb.find('.owl-item.active').first().index();
        let end = thumb.find('.owl-item.active').last().index();
        if (current > end) {
            thumb.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            thumb.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }
    function syncPosition2(el) {
        if (syncedSecondary) {
            let number = el.item.index;
            slider.data('owl.carousel').to(number, 100, true);
        }
    }
    thumb.on("click", ".owl-item", function(e) {
        e.preventDefault();
        let number = $(this).index();
        slider.data('owl.carousel').to(number, 300, true);
    });


    $(".qtyminus").on("click",function(){
        let now = $(".qty").val();
        if ($.isNumeric(now)){
            if (parseInt(now) -1> 0)
                { now--;}
            $(".qty").val(now);
        }
    })
    $(".qtyplus").on("click",function(){
        let now = $(".qty").val();
        let stok = $(".stok").val();
        if ($.isNumeric(now)){
            if(parseInt(now) < parseInt(stok))
            {
                $(".qty").val(parseInt(now)+1);    
            }

        }
    });


    $("select[name=provinsi]").on("change",function(){
        var id_provinsi = $(this).val();
        var prov_tujuan = $("option:selected",this).attr('prov_tujuan');
        $("input[name=prov_tujuan]").val(prov_tujuan);
        $("select[name=pilih_kota]").empty().append("<option></option>");
        $("select[name=pilih_kurir]").empty().append("<option></option>");
        $("select[name=pilih_layanan]").empty().append("<option></option>");
        $("input[name=tampil_ongkir]").val(null);

        $.ajax({
            type:"post",
            url:"http://localhost/shiba-petshop/actions/ongkir/kota.php",
            data:"id_provinsi="+id_provinsi,
            success:function(kota)
            {
                $("select[name=pilih_kota]").html(kota); 
            }
        })
    })

    $("select[name=pilih_kota]").change(function(){
        var id_kota = $(this).val();
        var kota_tujuan = $("option:selected",this).attr('kota_tujuan');
        $("input[name=kota_tujuan]").val(kota_tujuan);

        $("select[name=pilih_kurir]").empty().append("<option></option>");
        $("select[name=pilih_layanan]").empty().append("<option></option>");
        $("input[name=tampil_ongkir]").val(null);

        option_kurir =`<option>-pilih-</option>
        <option value="jne" kurir_name="JNE" >JNE</option>
        <option value="pos" kurir_name="POS Indonesia" >POS Indonesia</option>
        <option value="tiki" kurir_name="TIKI" >TIKI</option>`

        $.ajax({
            type:"post",
            url:"http://localhost/shiba-petshop/actions/ongkir/kota.php",
            data:"id_kota="+id_kota,
            success:function(kota)
            {
                $("select[name=pilih_kurir]").html(option_kurir); 
            }
        })
    })
    $("select[name=pilih_kurir]").change(function(){
        var kurir = $(this).val();
        var kurir_name = $("option:selected",this).attr("kurir_name");
        var id_kota = $("select[name=pilih_kota]").val();
        $("input[name=kurir]").val(kurir_name);
        $("select[name=pilih_layanan]").empty().append("<option></option>");
        $("input[name=tampil_ongkir]").val(null);
                // mendptkan total_berat
                var total_berat = $("input[name=total_berat]").val();
                $.ajax({

                    url:'http://localhost/shiba-petshop/actions/ongkir/ongkir.php',
                    type:'POST',
                    data: 'id_kota='+id_kota+'&kurir='+kurir+'&total_berat='+total_berat,
                    success:function(hasil)
                    {
                        // alert(hasil)
                        $("select[name=pilih_layanan]").html(hasil);
                    }
                })
            })

    $("select[name=pilih_layanan]").change(function(){
        var layanan = $(this).val();
        var biaya = $("option:selected",this).attr('biaya');
        var desc = $("option:selected",this).attr('desc');
        $("input[name=ongkir]").val(biaya);
        $("input[name=layanan]").val(desc);

        var total_belanja = $("input[name=total_belanja]").val();
        var total_biaya = parseInt(total_belanja) + parseInt(biaya);
        $("input[name=total_biaya]").val(total_biaya);
        $("input[name=tampil_ongkir]").val(biaya);

        
        
        // $("input[name=kurir]").val(kurir);
        //         // mendptkan total_berat
        //         var total_berat = $("input[name=total_berat]").val();
        //         $.ajax({

        //             url:'http://localhost/shiba-petshop/actions/ongkir/ongkir.php',
        //             type:'POST',
        //             data: 'id_kota='+id_kota+'&kurir='+kurir+'&total_berat='+total_berat,
        //             success:function(hasil)
        //             {
        //                 // alert(hasil)
        //                 $("select[name=layanan]").html(hasil);
        //             }
        //         })
    })




    $('input[name=sama]').on('click', function(){
        if ($('input[name=sama]').is(':checked')) {
            // alert("sama")
            var nama = $("input[name=nama]").val();
            var tlp = $("input[name=tlp]").val();
            var addr = $("input[name=addr]").val();

            $("input[name=nama_penerima]").val(nama);
            $("input[name=telp_penerima]").val(tlp);
            $("textarea[name=alamat_tujuan]").val(addr);
        }
        else
        {
            $("input[name=nama_penerima]").val(null);
            $("input[name=telp_penerima]").val(null);
            $("textarea[name=alamat_tujuan]").val(null);
        }
    })




    
});