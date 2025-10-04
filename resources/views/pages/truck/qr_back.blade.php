@php
    $truck = $driver ?? null;
    $truckNum = optional($truck)->truck_num ?? '';
    $hydrantName = optional(optional($truck)->hydrant)->name ?? '';
    $qrSvg = QrCode::format('svg')->size(4000)->margin(0)->generate($url);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck QR</title>
    <style>
        @page { size: 24in 24in; margin: 0; }
        html, body { height: 100%; }
        body { margin: 0; background: #fff; }
        .page {
            width: 24in;
            height: 24in;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
        .qr { width: 20in; height: 20in; display: flex; align-items: center; justify-content: center; }
        .qr svg { width: 100%; height: 100%; }
        .reg { margin-top: 0.5in; font-size: 1.2in; font-weight: 700; color: #000; }
        .hydrant { margin-top: 0.2in; font-size: 1in; font-weight: 600; color: #000; }
    </style>
    <script>
        window.addEventListener('load', function(){
            // Prevent pixel scaling when printing
            window.focus();
        });
    </script>
    {{-- Print at 100% scaling for exact 24in x 24in size. --}}
</head>
<body>
    <div class="page">
        <div class="qr">{!! $qrSvg !!}</div>
        <div class="reg">{{ $truckNum }}</div>
        @if($hydrantName)
            <div class="hydrant">{{ $hydrantName }}</div>
        @endif
    </div>
</body>
</html>

