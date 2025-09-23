@php
    $truck = $driver ?? null;
    $truckNum = optional($truck)->truck_num ?? '';
    $capacityName = optional(optional($truck)->truckCap)->name ?? '';
    $hydrantName = optional(optional($truck)->hydrant)->name ?? '';
    $hydrantLabel = $hydrantName ? strtoupper($hydrantName) : '';
    $reg = $truckNum ? ('# '.$truckNum) : '';
    $vehicleCodeLeft = 'VEHICLE CODE';
    $vehicleCodeRight = $truckNum ? $truckNum : '';
    $gallonLabel = $capacityName ? ($capacityName.'-GALLON') : '';
    $price = isset($truck->price) ? $truck->price : null; // adjust if you have another source
    $perKm = isset($truck->mileage_per_km) ? $truck->mileage_per_km : null; // adjust as needed
    $priceText = 'Rs:'.($price !== null ? number_format((float)$price, 0) : 'N/A');
    $perKmText = 'MILAGE P/KM Rs:'.($perKm !== null ? number_format((float)$perKm, 3) : 'N/A');
    $contractorText = 'KWSC CONTRACTOR';
    $regText = 'REG: '.$reg;
    $bottomArcText = $hydrantLabel ? ('KWSC '.strtoupper($hydrantLabel)) : 'KWSC HYDRANT';
    $qrSvg = QrCode::format('svg')->size(2000)->margin(0)->generate($url);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck QR Back</title>
    <style>
        @page { size: 24in 24in; margin: 0; }
        html, body { height: 100%; }
        body { margin: 0; background: #fff; }
        .canvas {
            width: 24in;
            height: 24in;
            position: relative;
            margin: 0 auto;
        }
        .badge {
            position: absolute;
            inset: 0;
            background: #7EC8F3; /* light blue */
            border-radius: 50%; /* circle/oval */
        }
        .content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            text-align: center;
            color: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
        }
        .qr {
            margin-top: 3in;
            width: 7.5in;
            height: 7.5in;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.2in;
        }
        .qr svg { width: 95%; height: 95%; }
        .title {
            margin-top: 1.2in;
            font-weight: 700;
            font-size: 1.1in;
            letter-spacing: 0.02in;
        }
        .line { margin-top: 0.5in; font-size: 0.9in; font-weight: 700; }
        .subline { margin-top: 0.3in; font-size: 0.7in; font-weight: 700; }
        /* SVG overlay for bottom arc text */
        .overlay-svg {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }
    </style>
    <script>
        window.addEventListener('load', function(){
            // Prevent pixel scaling when printing
            window.focus();
        });
    </script>
    {{-- Important: For exact physical size when printing, ensure printer scaling is 100% (no fit-to-page). --}}
    {{-- The QR is SVG for unlimited resolution. --}}
    {{-- All texts are dynamic based on $driver and related models. --}}
</head>
<body>
    <div class="canvas">
        <div class="badge"></div>
        <div class="content">
            <div class="qr">{!! $qrSvg !!}</div>
            <div class="title">{{ $vehicleCodeLeft }} {{ $vehicleCodeRight ? ' - '.$vehicleCodeRight : '' }}</div>
            @if($gallonLabel)
                <div class="line">{{ $gallonLabel }}</div>
            @endif
            <div class="subline">{{ $priceText }} - EXT: {{ $perKmText }}</div>
            <div class="subline">{{ $contractorText }}</div>
            <div class="subline">{{ $regText }}</div>
        </div>

        <!-- Bottom arced text using SVG textPath -->
        <svg class="overlay-svg" viewBox="0 0 2400 2400" preserveAspectRatio="xMidYMid meet">
            <defs>
                <!-- Large circle path slightly inset for the text to sit near the edge -->
                <path id="bottomArc" d="M 200 1200 a 1000 1000 0 1 0 2000 0" />
            </defs>
            <text fill="#ffffff" font-family="Arial, Helvetica, sans-serif" font-size="120" font-weight="700">
                <textPath startOffset="50%" text-anchor="middle" href="#bottomArc">{{ $bottomArcText }}</textPath>
            </text>
        </svg>
    </div>
</body>
</html>


