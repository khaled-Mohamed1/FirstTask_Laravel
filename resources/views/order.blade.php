@extends('layouts.layout');

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>main</title>
</head>


<body style="font-family: Cairo; direction: rtl;">

    <div class="container">
        <form action="{{ route('order.store') }}" method="POST">

            @csrf
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label class="col-form-label">الصنف</label>
                </div>
                <div class="col-auto">
                    <select name="item" class="form-select" aria-label="Default select example">
                        <option value="سولار" selected>سولار</option>
                        <option value="بنزين" selected>بنزين</option>
                    </select>
                </div>
            </div>


            <br>



            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label class="col-form-label">الكمية</label>
                </div>
                <div class="col-auto">
                    <input name="quantity" type="number" class="form-control">
                </div>
            </div>

            <br>

            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <input name="kind" value="لتر" class="form-check-input" type="radio" name="flexRadioDefault"
                        id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        لتر
                    </label>
                </div>
                <br>
                <div class="col-auto">
                    <input name="kind" value="شيكل" class="form-check-input" type="radio" name="flexRadioDefault"
                        id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        مبلغ
                    </label>
                </div>
            </div>

            <br>

            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label class="col-form-label">السائق</label>
                </div>
                <div class="col-auto">
                    <select name="driver_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>None</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <br>

            <input type="hidden" name="condition" value="تم الإستلام">
            <button type="submit" class="btn btn-primary">اعتماد</button>

        </form>

        <hr>
        @if ($message = Session::get('success'))
            <div class="alert alert-primary" role="alert">
                {{ $message }}
            </div>
        @endif
        <h2>الطلبات السابقة</h2>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">رقم الطلب</th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">الصنف</th>
                    <th scope="col">الكمية</th>
                    <th scope="col">السائق</th>
                    <th scope="col">الحالة</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->item }}</td>
                        <td>{{ $order->quantity }} {{ $order->kind }}</td>
                        <td>{{ $order->NameDriver->name }}</td>
                        {{-- <td>{{ $driver->name }}</td> --}}
                        <td>{{ $order->condition }}</td>
                        <td>
                            @if ($order->condition == 'تم الإيقاف')
                            @else
                                <a class="btn btn-primary" href="{{ route('order.update', $order->id) }}"
                                    role="button"
                                    onclick="return confirm('Are You Sure To Update The condition')">Update</a>
                            @endif
                            <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"
                                    onclick="return confirm('Are You Sure To Delete')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $orders->links() !!}
    </div>

</body>

</html>
