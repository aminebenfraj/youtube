@extends('layouts.app')

@section('content')
<section class="px-6 pb-6 pt-14 flex flex-col items-center">
    <h1 class="mb-20 text-2xl text-gray-200">Upload a video</h1>
	<form enctype="multipart/form-data" novalidate="" action="{{ route('videos.store') }}" method="post" class="container w-3/4 flex flex-col mx-auto space-y-12">
		@csrf
		<fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm">
			<div class="space-y-2 col-span-full lg:col-span-1 text-gray-300">
				<p class="font-medium">Tell us about the video</p>
				<p class="text-xs">Make it interesting for more clicks!</p>
			</div>
			<div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
			<div class="col-span-full mt-10 flex justify-center">
				<label for="video" class="relative w-40 h-40 text-xl border border-zinc-50 text-gray-300 cursor-pointer rounded flex items-center justify-center my-10 flex-col">
					Upload video
					<img src="{{ asset('upload.png') }}" alt="" class="w-14" />
				</label>
				<input
                        type="file"
                        class="sr-only invisible"
                        name="video" 
						required
						id="video"
						accept="video/*"
                      />

				</div>
                      
				<div class="col-span-full">
					<label for="title" class="text-gray-300">Title</label>
					<input id="title" type="text" name="title" placeholder="Insert a title for your video" class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
				</div>
				<div class="col-span-full mt-10">
					<label for="description" class="text-gray-300">Description</label>
					<textarea id="description" name="description" placeholder="" class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2 h-52"></textarea>
				</div>
				<div class="col-span-full mt-10">
					<p class="text-gray-300">Add a thumbnail</p>
					<div class="relative flex flex-col gap-3 items-center justify-center mt-2 group w-[380px] h-52 rounded-md overflow-hidden bg-primary">
					<img src="{{ asset('thumbnail-placeholder.jpg') }}" id="thumbnail-image" alt="" class="w-full h-full object-contain">
						<div class="absolute inset-0 hidden group-hover:block bg-primary/50">
                            <label  for="thumbnail" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 text-lg rounded-full border border-gray-600 bg-gray-600 text-gray-200 flex items-center justify-center">
                                <span class="material-icons">
                                    add_photo_alternate
                                </span>
							</label>
							<input type="file" class="invisible" name="thumbnail" id="thumbnail" accept="image/*" class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
                        </div>
					</div>
				</div>
                <div class="col-span-full flex justify-center mt-10">
                    <button class="px-10 py-2 bg-secondary rounded-md text-white hover:bg-gray-700">
                        Upload
                    </button>
                </div>
			</div>
		</fieldset>
	</form>
</section>
<script>
    const thumbnailImage = document.getElementById('thumbnail-image')
    const thumbnailInput = document.getElementById('thumbnail')
    thumbnailInput.addEventListener("change", (e) => {
        const target = e.target;
        const files = target?.files;
        const reader = new FileReader();
        reader.onload = async function () {
            if (reader.result)
                thumbnailImage.src = reader.result
        };
        if (files) reader.readAsDataURL(files[0]);
    })
</script>
@endsection
