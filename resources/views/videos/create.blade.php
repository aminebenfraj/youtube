@extends('layouts.app')

@section('content')
<section class="px-6 pb-6 pt-14 flex flex-col items-center">
    <h1 class="mb-20 text-2xl text-gray-200">Upload a video</h1>
	<form enctype="multipart/form-data" novalidate="" action="{{ route('videos.store') }}" method="post" class="container w-3/4 flex flex-col mx-auto space-y-12">
		<fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm">
			<div class="space-y-2 col-span-full lg:col-span-1 text-gray-300">
				<p class="font-medium">Tell us about the video</p>
				<p class="text-xs">Make it interesting for more clicks!</p>
			</div>
			<div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
			<div class="col-span-full mt-10">
				<label for="video" class="text-gray-300">Upload Video</label>
					<input type="file" name="video" accept="video/*" class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
				</div>
				<div class="col-span-full">
					<label for="title" class="text-gray-300">Title</label>
					<input id="title" type="text" placeholder="Insert a title for your video" class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
				</div>
				<div class="col-span-full mt-10">
					<label for="description" class="text-gray-300">Description</label>
					<textarea id="description" placeholder="" class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2 h-52"></textarea>
				</div>
				<div class="col-span-full mt-10">
					<label for="bio" class="text-gray-300">Add a thumbnail</label>
					<div class="relative w-fit flex flex-col gap-3 items-start mt-2 group">
						<img src="https://source.unsplash.com/30x30/?random" alt="" class="w-[380px] h-52 rounded-md">
						<div class="absolute inset-0 hidden group-hover:block bg-primary/50">
                            <button type="button" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 text-lg rounded-full border border-gray-600 bg-gray-600 text-gray-200">
                                <span class="material-icons">
                                    add_photo_alternate
                                </span>
                            </button>
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
@endsection
