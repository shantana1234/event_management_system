<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header" style="background-color:rgb(18, 78, 20); color: white;">
                <h6 class="modal-title" id="exampleModalLabel">
                <i class="bi bi-calendar-plus"></i>&nbsp; Add a new event
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
        <form id="eventForm">
          <!-- Event Name -->
          <div class="mb-3">
            <label for="event_name" class="form-label">
              <i class="bi bi-fonts"></i> Event Name
            </label>
            <input type="text" id="event_name" name="event_name" class="form-control" placeholder="Enter event name" required>
          </div>

           <!-- Event Description -->
          <div class="mb-3">
            <label for="event_description" class="form-label">
              <i class="bi bi-card-text"></i> Description
            </label>
            <textarea 
              id="event_description" 
              name="event_description" 
              rows="3" 
              class="form-control" 
              placeholder="Enter event description" 
              style="max-height: 120px; overflow-y: auto; background-color: #f9f9f9; border-color: #ddd;" 
              required>
            </textarea>
          </div>


          <!-- Event Date -->
          <div class="mb-3">
            <label for="event_date" class="form-label">
              <i class="bi bi-calendar"></i> Event Date
            </label>
            <input type="date" id="event_date" name="event_date" class="form-control" required>
          </div>

          <div class="row">
    <!-- Maximum Capacity -->
            <div class="col-md-6 mb-3">
              <label for="event_capacity" class="form-label">
                <i class="bi bi-people-fill"></i> Maximum Capacity
              </label>
              <input 
                type="number" 
                id="event_capacity" 
                name="event_capacity" 
                class="form-control" 
                placeholder="Enter maximum capacity" 
                min="1" 
                required 
                style="background-color: #f9f9f9; border-color: #ddd;">
            </div>

    <!-- Event Status -->
            <div class="col-md-6 mb-3">
              <label for="event_status" class="form-label">
                <i class="bi bi-flag-fill"></i> Event Status
              </label>
              <select 
                id="event_status" 
                name="event_status" 
                class="form-select" 
                style="background-color: #f9f9f9; border-color: #ddd;" 
                required>
                <option value="">Select status</option>
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
              </select>
            </div>
            </div>


        
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer" style="background-color: #f8f9fa;">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                <i class="bi bi-x-circle"></i> Close
              </button>
              <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Save Event
              </button>
            </div>
         </form>
    </div>
  </div>
</div>

