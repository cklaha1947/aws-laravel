<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        input,
        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background: #0d6efd;
            color: white;
            border: none;
            cursor: pointer;
        }

        #responseMessage {
            padding: 10px;
            margin-bottom: 15px;
            display: none;
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .failure {
            background: #f8d7da;
            color: #842029;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Contact Us</h2>

        <div id="responseMessage"></div>

        <form id="contactForm" enctype="multipart/form-data">

            @csrf

            <input type="text" name="name" placeholder="Your Name" required>

            <input type="email" name="email" placeholder="Your Email" required>

            <input type="text" name="subject" placeholder="Subject" required>

            <textarea name="message" placeholder="Your Message" rows="4" required></textarea>

            <label>Attachment 1</label>
            <input type="file" name="attachment1" accept=".jpg,.jpeg,.png,.pdf">

            <label>Attachment 2</label>
            <input type="file" name="attachment2" accept=".jpg,.jpeg,.png,.pdf">

            <label>Attachment 3</label>
            <input type="file" name="attachment3" accept=".jpg,.jpeg,.png,.pdf">

            <label>Attachment 4</label>
            <input type="file" name="attachment4" accept=".jpg,.jpeg,.png,.pdf">

            <label>Attachment 5</label>
            <input type="file" name="attachment5" accept=".jpg,.jpeg,.png,.pdf">

            <button type="submit" id="submitBtn">Send Message</button>

        </form>
    </div>

    <script>
        $(document).ready(function() {

            $('#contactForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{url('/contact')}}",
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        alert('Email sent successfully!');
                        $('#contactForm')[0].reset();
                    },

                    error: function() {
                        alert('Failed to send email!');
                    }
                });
            });

        });
    </script>

</body>

</html>
