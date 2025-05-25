<script src="{{ asset('frontend/js/custom.js') }}"></script>
@php
    $g_settings = \App\Models\GeneralSetting::where('id', 1)->first();
@endphp
@if($g_settings->layout_direction == 'ltr')
    <script src="{{ asset('frontend/js/ltr.js') }}"></script>
@endif
@if($g_settings->layout_direction == 'rtl')
    <script src="{{ asset('frontend/js/rtl.js') }}"></script>
@endif

@if ($errors->any())
    @foreach($errors->all() as $error)
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: 'error',
                title: '{{ $error }}'
            });
        </script>
    @endforeach
@endif

@if(session()->get('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1800,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: 'error',
            title: '{{ session()->get("error") }}'
        });
    </script>
@endif

@if(session()->get('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1800,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session()->get('success') }}"
        });
    </script>
@endif

@if($g_setting->tawk_live_chat_status == 'Show')
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/{{ $g_setting->tawk_live_chat_property_id }}/1fapclhaj';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
@endif

<!--Start of Google Translate Script-->
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

<style>
    #google_translate_element a {
        font-size: 14px;
    }

    #google_translate_element select {
        background: transparent;
        border: none;
        font-size: 14px;
        color: inherit;
        cursor: pointer;
        padding: 4px 8px;
        font-family: inherit;

    }

    #google_translate_element .goog-te-gadget-icon {
        display: none !important;
    }

    #google_translate_element img {
        height: auto;
    }
</style>
<!--End of Google Translate Script-->

<!--Start of Geolocation API Script-->
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }

    function successCallback(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        const apiKey = "{{ env('OPENCAGE_API_KEY') }}";
        const url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${apiKey}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.results && data.results.length > 0) {
                    const components = data.results[0].components;

                    const city = components.city || components.town || components.village || '';
                    const country = components.country || '';
                    const road = components.road || '';
                    const suburb = components.suburb || '';
                    const neighbourhood = components.neighbourhood || '';
                    const house = components.house || '';
                    const postcode = components.postcode || '';
                    const state = components.state || '';
                    const areaParts = [house, road, suburb, neighbourhood, state, postcode].filter(Boolean).join(', ');

                    const fullLocation = city && country ? `${city}, ${country}` : country;
                    let matched = false;

                    const locationSelect = document.querySelector('select[name="location"]');
                    if (locationSelect) {
                        const options = locationSelect.options;
                        for (let i = 0; i < options.length; i++) {
                            const optionText = options[i].text.trim().toLowerCase();
                            if (optionText.includes(city.toLowerCase()) && optionText.includes(country.toLowerCase())) {
                                locationSelect.selectedIndex = i;
                                $(locationSelect).trigger('change');
                                matched = true;
                                break;
                            }
                        }
                    }

                    const textInput = document.querySelector('input[name="text"]');
                    if (textInput) {
                        if (matched) {
                            // If matched, fill other parts of address (excluding city, country)
                            textInput.value = areaParts;
                        } else {
                            // If no match, put all location info in textbox
                            const fallbackAddress = [areaParts, fullLocation].filter(Boolean).join(', ');
                            textInput.value = fallbackAddress;
                        }
                    }
                }
            })
            .catch(err => {
                console.error('Geocoding error:', err);
            });
    }

    function errorCallback(error) {
        console.warn(`Geolocation error (${error.code}): ${error.message}`);
    }
});
</script>
<!--End of Geolocation API Script-->
