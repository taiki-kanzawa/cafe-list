<!-- Wi-Fiのアイコン -->
@if ($cafe->wifi == 'あり')
    <span class="bg-info text-white available-facility">
        <i class="fas fa-wifi"></i>
    </span>
@endif

<!-- コンセントのアイコン -->
@if ($cafe->electrical_outlet == 'あり')
    <span class="bg-warning text-white available-facility">
        <i class="fas fa-plug"></i>
    </span>
@endif

<!-- 喫煙・禁煙のアイコン -->
@if ($cafe->smoking_seat == 'あり')
    <span class="bg-success text-white available-facility">
        <i class="fas fa-smoking"></i>
    </span>
@else
    <span class="bg-danger text-white available-facility">
        <i class="fas fa-smoking-ban"></i>
    </span>
@endif

<!-- 駐車場のアイコン -->
@if ($cafe->parking == 'あり')
    <span class="bg-primary text-white available-facility">
        <i class="fas fa-parking"></i>
    </span>
@endif