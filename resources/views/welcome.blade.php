<!DOCTYPE html>
<html>
<head>

    <title>paytabs task </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

</head>

<body>


<div class="container">
    <h1>PayTabs Task</h1>
    <hr>
    <form>
        <div class="form-group" id="categories">
            <label>main category</label>
            <select name="main_category_select" id="main_category_select" class="form-control input-lg"
                    onchange="handleSelectChange(event)">
                <option name="main_category_option" value="0">choose main category</option>
                @foreach ($main_categories as $category)
                    <option name="main_category_option"
                            value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

    </form>
</div>
<script type="text/javascript">

    let sub_counter = 0;

    function remove_duplicated(sub_counter) {
        const element = document.getElementById("sub_category_" + sub_counter);
        if (element != null) {
            element.remove();
        }
    }

    function create_option(select, value, innerHTML) {
        var option = document.createElement("option");
        option.value = value;
        option.innerHTML = innerHTML
        select.appendChild(option);
    }

    function handleSelectChange(event) {

        var selectElement = event.target;
        var category_id = selectElement.value;

        var hasNumber = /\d/;
        if (!hasNumber.test(selectElement.id)) {
            const elements = document.getElementsByClassName("sub_category");

            $.each(elements, function (key, element) {
                remove_duplicated(sub_counter)
                sub_counter--;
            });
            sub_counter = 0

        } else {
            const check_sub_counter = (selectElement.id).split("_");
            for (let i = check_sub_counter[2]; i < sub_counter; i++) {
                console.log(i)
                remove_duplicated(i)
            }
            sub_counter = check_sub_counter[2]
        }

        $.ajax({
            url: "{{url('fetch_sub_category')}}",
            type: "POST",
            data: {
                category_id: category_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                var select = document.createElement("select");
                select.id = "sub_category_" + sub_counter;
                select.className = 'form-control input-lg sub_category'
                select.setAttribute('onchange', "handleSelectChange(event)")

                create_option(select, 0, 'choose sub category')

                $.each(result.main_categories, function (key, category) {
                    create_option(select, category.id, category.category_name)
                });

                var hasNumber = /\d/;
                var main_category_select;
                if (!hasNumber.test(selectElement.id)) {
                    main_category_select = document.getElementById("main_category_select");
                } else {
                    const check_sub_counter = (selectElement.id).split("_");
                    main_category_select = document.getElementById("sub_category_" + check_sub_counter[2]);
                }
                $(select).insertAfter(main_category_select);
            }
        });

        sub_counter++;
    }
</script>
</body>
