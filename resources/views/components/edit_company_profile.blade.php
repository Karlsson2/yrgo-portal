<div class="company-profile">
    <div class="profile-header">
        <div class="profile-img">
            @if ($user->profile_picture == null)
            <img src="/images/profiles/default_image_company.png" alt="">
            @else
            <img src="{{ $user->profile_picture }}" alt="">
            @endif
        </div>
        <div class="profile-info">
            <div class="info">
                <input field="text" class="name" id="name" name="name" value="{{ $user->name }}" placeholder="Företagsnamn">
            </div>
            <!-- LOCATION -->
            <input field="text" class="location" id="location" name="location" value="{{ $extraInfo->location }}" placeholder="Storgatan 1, Göteborg">
            <a href="{{ route('profile') }}">Avbryt</a>

        </div>

    </div>

    <div class="profile-main">
        <!-- ABOUT ME -->
        <div class="main-section">
            <h2 class="title-4">Om mig</h2>
            <textarea id="description" name="description" rows="4" class="form-control">{{ $user->description ?? '' }}</textarea>

        </div>
        <div class="divider"></div>

        <!-- COMPETENCIES -->
        <div class="main-section">
            <h2 class="title-4">Kompetenser</h2>
            <!-- Technologies-->
            <div class="technologies">
                <!-- Display selected technologies -->
                <div class="selected-technologies">
                    @foreach($user->technologies as $technology)
                    <div class="technology-checkbox selected">
                        <label>{{ $technology->name }}</label>
                        <input type="checkbox" name="technologies[]" value="{{ $technology->id }}" checked>
                    </div>
                    @endforeach
                </div>
                <div class="more-technologies">Se fler kompetenser</div>
                <div class="unselected-technologies">
                    <!-- Hide unselected technologies intitially -->
                    @foreach($technologies as $technology)
                    @if (!$user->technologies->contains($technology))
                    <div class="technology-checkbox">
                        <label>{{ $technology->name }}</label>
                        <input type="checkbox" name="technologies[]" value="{{ $technology->id }}">
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="main-section">
            <!-- CONTACT -->
            <h2 class="title-4">Kontakt</h2>
            <ul>
                @foreach ([
                'phone' => ['label' => 'Telefon', 'type' => 'phone', 'icon' => '/images/icons/phone.svg', 'value' => $user->phone ?? '', 'placeholder' => 'Telefon'],
                'linkedin' => ['label' => 'LinkedIn', 'type' => 'url', 'icon' => '/images/icons/linkedin.svg', 'value' => $user->linkedin, 'placeholder' => 'LinkedIn'],
                'instagram' => ['label' => 'instagram', 'type' => 'url', 'icon' => '/images/icons/instagram.svg', 'value' => $user->facebook, 'placeholder' => 'Instagram'],
                'website' => ['label' => 'Hemsida', 'type' => 'url', 'icon' => '/images/icons/instagram.svg', 'value' => $user->website ?? '', 'placeholder' => 'www.exempel.se']
                ] as $field => $attributes)
                <!-- Input fields-->
                <li>
                    <img src="{{ $attributes['icon'] }}" alt="">
                    <input type="{{ $attributes['type'] }}" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ $attributes['value'] }}" placeholder="{{ $attributes['placeholder'] }}">
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>