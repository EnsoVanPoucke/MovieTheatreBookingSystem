<div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
	<div class="flex h-20 items-center justify-between">

		{{-- logo --}}
		<div class="flex items-center">
			<img src="images/icons/filmXperience.png"
				alt="filmXperience"
				class="h-auto w-[250px]"
				loading="lazy">
		</div>

		{{-- login/register navigation --}}
		@if (Route::has('login'))
			<nav class="flex items-center justify-end gap-4">
				@auth
				{{-- 
				<a
				href="{{ url('/dashboard') }}"
				class="inline-block px-5 py-1.5 border-[#19244050] hover:border-[#ffffff] border-2 text-[#1b1b18] text-sm leading-normal"
				>
				Dashboard
				</a>
				--}}



{{-- User dropdown --}}
            <div class="relative">
                <button class="flex items-center px-5 py-1.5 border-[#19244050] hover:border-[#ffffff] border-2 text-[#1b1b18] text-sm leading-normal" id="userDropdown">
                    {{ Auth::user()->name }} 
                    <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                {{-- Dropdown menu --}}
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 shadow-lg hidden z-50">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
            
            {{-- Dropdown script --}}
            <script>
                document.getElementById('userDropdown').addEventListener('click', function () {
                    document.getElementById('dropdownMenu').classList.toggle('hidden');
                });

                document.addEventListener('click', function (event) {
                    if (!document.getElementById('userDropdown').contains(event.target)) {
                        document.getElementById('dropdownMenu').classList.add('hidden');
                    }
                });
            </script>



				@else
					<a
						href="{{ route('login') }}"
						class="inline-block px-5 py-1.5 border-[#19244050] hover:border-[#ffffff] text-[#1b1b18] border-2 text-sm leading-normal"
					>
						Log in
					</a>

					@if (Route::has('register'))
						<a
							href="{{ route('register') }}"
							class="inline-block px-5 py-1.5 border-[#19244050] hover:border-[#ffffff] border-2 text-[#1b1b18] text-sm leading-normal">
							Register
						</a>
					@endif
				@endauth
			</nav>
		@endif
	</div>
</div>