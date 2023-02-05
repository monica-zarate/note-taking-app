<!-- This partial is used to create a preview of a note's details and offers Edit and Delete buttons that re-direct the user to the appropriate page, and assigns the id to the url path according to the selected note -->

<article class="col-span-4">
    <div class="rounded overflow-hidden shadow-lg border">
        <div class="px-6 py-4">
            <div class="flex items-center">
                <h3 class="font-bold text-2xl mb-1 flex-grow"><?php echo h($note['name']); ?></h3>
                <span class="text-white rounded-full text-sm bg-green-500 px-3 py-1"><?php echo h($note['course_number']); ?></span>
                <a href="<?php echo get_public_url('/notes/edit.php?id=' . u($note['id'])); ?>" class="text-white rounded-full text-sm bg-purple-500 px-3 py-1 ml-2">Edit</a>
                <a href="<?php echo get_public_url('/notes/delete.php?id=' . u($note['id'])); ?>" class="text-white rounded-full text-sm bg-red-500 px-3 py-1 ml-2">Delete</a>
            </div>
            <p class="text-xl my-4"><?php echo h($note['body']); ?></p>
        </div>
    </div>
</article>