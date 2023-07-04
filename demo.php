<form method="POST" action="">
        <label>Subject:</label><br>
        <select name="subject" required>
            <option value="">Select a subject</option>
            <?php while ($subject = mysqli_fetch_assoc($subjectResult)) { ?>
                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subject']; ?></option>
            <?php } ?>
        </select><br><br>

        <label>Chapters:</label><br>
        <select name="chapters[]" multiple required>
            <?php while ($chapter = mysqli_fetch_assoc($chapterResult)) { ?>
                <option value="<?php echo $chapter['id']; ?>"><?php echo $chapter['chapter']; ?></option>
            <?php } ?>
        </select><br><br>

        <input type="submit" value="Assign">
    </form>