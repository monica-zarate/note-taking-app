<!-- This partial is used to create a the cards container, it's making use of the card partial passing each note using a while loop. It also contains the Add New button that re-direct the user to the create note page -->

<!-- Index Header -->
<div class="grid grid-cols-12 border-b pb-6">
    <div class="col-span-12 flex items-center">
        <h1 class="font-bold text-4xl flex-grow">My Notes</h1>
        <a class="bg-emerald-500 rounded-full py-2 px-4 text-white font-bold" href="<?php echo get_public_url('/notes/create.php'); ?>">Add New</a>
    </div>
</div>
<!-- End: Index Header -->

<!-- Index Loop -->
<div class="grid gap-6 grid-cols-12 mt-6">
    <?php while ($note = $notes->fetch_assoc()) {
        include(get_path('public/partials/notes/card.php'));
    } ?>
</div>
<!-- End: Index Loop -->