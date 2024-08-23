<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="icon" type="image/x-svg" href="/img/hdcevents_logo.svg" sizes="32x32" />
        {{-- GOOGLE FONTS  --}}
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
        rel="stylesheet" />
        {{-- CSS --}}
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
             rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
             crossorigin="anonymous">
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/uploader-img.css">

    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div id="navbar" class="collapse navbar-collapse">
                    <a href="/" class="navbar-brand">
                        <img src="/img/hdcevents_logo.svg" alt="HDC Events">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Events</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Create Event</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">My events</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout"
                                class="nav-link"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                Logout
                            </a>
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Register</a>
                        </li>
                        @endguest
                        </ul>
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    @if(session('msg'))
                        <p class="msg">{{ session('msg') }}</p>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
        <footer>
            <p>HDC Events &copy; 2024</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous">
        </script>
        <script type="module" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.esm.js"></script>
        <script>
            /* Bootstrap 5 JS included */

console.clear();
("use strict");

// Drag and drop - single or multiple image files
// https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
// https://codepen.io/joezimjs/pen/yPWQbd?editors=1000
(function () {
    "use strict";

    // Four objects of interest: drop zones, input elements, gallery elements, and the files.
    // dataRefs = {files: [image files], input: element ref, gallery: element ref}

    const preventDefaults = (event) => {
        event.preventDefault();
        event.stopPropagation();
    };

    const highlight = (event) => event.target.classList.add("highlight");

    const unhighlight = (event) => event.target.classList.remove("highlight");

    const getInputAndGalleryRefs = (element) => {
        const zone = element.closest(".upload_dropZone") || false;
        const gallery = zone.querySelector(".upload_gallery") || false;
        const input = zone.querySelector('input[type="file"]') || false;
        return { input: input, gallery: gallery };
    };

    const handleDrop = (event) => {
        const dataRefs = getInputAndGalleryRefs(event.target);
        dataRefs.files = event.dataTransfer.files;
        handleFiles(dataRefs);
    };

    const eventHandlers = (zone) => {
        const dataRefs = getInputAndGalleryRefs(zone);

        if (!dataRefs.input) return;

        // Prevent default drag behaviors
        ["dragenter", "dragover", "dragleave", "drop"].forEach((event) => {
            zone.addEventListener(event, preventDefaults, false);
            document.body.addEventListener(event, preventDefaults, false);
        });

        // Highlighting drop area when item is dragged over it
        ["dragenter", "dragover"].forEach((event) => {
            zone.addEventListener(event, highlight, false);
        });
        ["dragleave", "drop"].forEach((event) => {
            zone.addEventListener(event, unhighlight, false);
        });

        // Handle dropped files
        zone.addEventListener("drop", handleDrop, false);

        // Handle browse selected files
        dataRefs.input.addEventListener(
            "change",
            (event) => {
                dataRefs.files = event.target.files;
                handleFiles(dataRefs);
            },
            false
        );
    };

    // Initialise ALL dropzones
    const dropZones = document.querySelectorAll(".upload_dropZone");
    for (const zone of dropZones) {
        eventHandlers(zone);
    }

    // No 'image/gif' or PDF or webp allowed here, but it's up to your use case.
    // Double checks the input "accept" attribute
    const isImageFile = (file) =>
        ["image/jpeg", "image/png", "image/jpg"].includes(file.type);

    function previewFiles(dataRefs) {
        if (!dataRefs.gallery) return;
        let imgOld = document.querySelector("img.upload_img")
        for (const file of dataRefs.files) {
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function () {
                if(!!imgOld){
                    dataRefs.gallery.removeChild(imgOld)
                }
                let img = document.createElement("img");
                img.className = "upload_img mt-2";
                img.setAttribute("alt", file.name);
                img.src = reader.result;
                dataRefs.gallery.appendChild(img);
            };
        }
    }

    // Based on: https://flaviocopes.com/how-to-upload-files-fetch/
    const imageUpload = (dataRefs) => {
        // Multiple source routes, so double check validity
        if (!dataRefs.files || !dataRefs.input) return;

        const url = dataRefs.input.getAttribute("data-post-url");
        if (!url) return;

        const name = dataRefs.input.getAttribute("data-post-name");
        if (!name) return;

        const formData = new FormData();
        formData.append(name, dataRefs.files);

        fetch(url, {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("posted: ", data);
                if (data.success === true) {
                    previewFiles(dataRefs);
                } else {
                    console.log("URL: ", url, "  name: ", name);
                }
            })
            .catch((error) => {
                console.error("errored: ", error);
            });
    };

    // Handle both selected and dropped files
    const handleFiles = (dataRefs) => {
        let files = [...dataRefs.files];
        // Only select the first file
        let file = files[0];
        // Remove unaccepted file types
        if (!isImageFile(file)) {
            console.log("Not an image, ", file.type);
            return;
        }
        // Update dataRefs with the accepted single file
        dataRefs.files = [file];
        // Proceed with preview and upload
        previewFiles(dataRefs);
        imageUpload(dataRefs);
    };
})();

        </script>
    </body>
</html>
