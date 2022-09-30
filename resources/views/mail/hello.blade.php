<!DOCTYPE html>
<html>

<head>
    <title>ItsolutionStuff.com</title>
</head>

<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>

    <p>ข้อมูลการจองห้องพัก</p>
    <p>ชื่อห้องพัก: {{ $mailData['room_name'] }}</p>
    <p>ประเภทห้องพัก: {{ $mailData['room_type'] }}</p>
    <p>ชื่อลูกค้า: {{ $mailData['customer_name'] }}</p>
    <p>ราคา: {{ $mailData['price'] }}</p>
    <p>จำนวนเด็กที่ทำการเข้าพัก: {{ $mailData['guest_adult'] }}</p>
    <p>จำนวนผู้ใหญ่ที่ทำการเข้าพัก: {{ $mailData['guest_child'] }}</p>
    <p>เวลาที่เช็คอิน: {{ $mailData['checkin'] }}</p>
    <p>เวลาที่เช็คเอ้าท์: {{ $mailData['checkout'] }}</p>

    {{-- {!! QrCode::size(300)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9') !!} --}}

    @php
        $qrCodeAsPng = QrCode::size(500)->generate('my text for the QR code');
    @endphp

    {{ $qrCodeAsPng }}
</body>

</html>
