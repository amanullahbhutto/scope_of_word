<form action="{{ route('import.company') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- File input for Excel -->
        <div class="mb-3">
            <label for="file" class="form-label">Upload Excel File</label>
            <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls,.csv" required>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Import</button>
    </form>