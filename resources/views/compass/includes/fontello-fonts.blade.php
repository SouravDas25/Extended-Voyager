<div class="row">
    <div class="col-md-12">
        <div class="input-group form-sm form-2 pl-0 mb-0">
            <input class="form-control my-0 py-1 grey-border" type="text" placeholder="Search" aria-label="Search" id="iconSearch">
            <div class="input-group-append" onclick="searchFontelloIcons()">
                <span class="input-group-text waves-effect bg-primary" id="basic-addon1">
                    <a type="button" >
                        <i class="fa fa-search text-white" aria-hidden="true"></i>
                    </a>
                </span>
            </div>
        </div>
        <div class="progress primary-color-dark mt-3" id="loaderICon" style="display: none">
            <div class="indeterminate"></div>
        </div>
    </div>
</div>
<div class="row mt-5" id="fontelloIconList" >
    <div class="col-sm-4">
        <table class="table table-sm table-striped table-bordered w-100" >
            <thead class="mdb-color darken-2 text-white">
            <tr>
                <th>Icon</th>
                <th>ClassName</th>
            </tr>
            </thead>
            <tbody id="fontelloIcons1">
            </tbody>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-sm table-striped table-bordered w-100" >
            <thead class="mdb-color darken-2  text-white">
            <tr>
                <th>Icon</th>
                <th>ClassName</th>
            </tr>
            </thead>
            <tbody id="fontelloIcons2">
            </tbody>
        </table>
    </div>
    <div class="col-sm-4">
        <table class="table table-sm table-striped table-bordered w-100" >
            <thead class="mdb-color darken-2 text-white">
            <tr>
                <th>Icon</th>
                <th>ClassName</th>
            </tr>
            </thead>
            <tbody id="fontelloIcons3">
            </tbody>
        </table>
    </div>
</div>


<script>
    function fontFontsExplode(data) {
        var prefx = data.css_prefix_text;
        data.glyphs.forEach(function (item,key) {
            var classname = prefx + item.css;
            var icndom = '<td style="font-size:20px;" ><i class="'+ classname+' font-size-40 px-2" ></i></td>' +
                '<td class="font-weight-800">' + classname +'</td>';
            var icn = '<tr>' +
                icndom + '</tr>';
            var is = key % 3 + 1;
            var id = '#fontelloIcons' + is.toString();
            $(id).append(icn);
        })
    }

    function searchFontelloIcons() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("iconSearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("fontelloIconList");

        tr = table.getElementsByTagName("tr");
        var loader = document.getElementById("loaderICon");

        loader.style.display = "";

        //console.log(tr);
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            tr[i].style.display = "";
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        loader.style.display = "none";
    }
</script>