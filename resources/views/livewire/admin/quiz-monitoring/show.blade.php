<div>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    let studentsData = @json($students);
    let lastEventTime = {};
    document.addEventListener("DOMContentLoaded", function() {

      // Pusher.logToConsole = true;
      var pusher = new Pusher('a4d309ca85a9cd7b3d32', {
        cluster: 'ap1'
      });
      pusher.subscribe("quiz." + {{ $quiz->id }}).bind("App\\Events\\UserOnline", function(data) {
        // console.log("success");
        // console.log(JSON.stringify(data));
        // console.log(data);
        updateData(data)
        updateTable()
      })

      function updateData(data) {
        studentsData.forEach((student, index) => {
          if (student.id == data.studentId) {
            student.status = data.status
            lastEventTime[student.id] = new Date().getTime();
          }
        })
      }

      function getStatusLabel(status) {
        switch (status) {
          case 'offline':
            return '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Offline</span>';
          case 'online':
            return '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Online</span>';
          case 'done':
            return '<span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Selesai</span>';
          default:
            return '';
        }
      }

      function updateTable() {
        // console.log(studentsData);
        const tableBody = document.getElementById('students-table-body');
        tableBody.innerHTML = '';

        studentsData.forEach((student, index) => {
          const row = `
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <td class="px-6 py-2 text-nowrap font-medium text-gray-900 whitespace-nowrap dark:text-white">${index + 1}</td>
              <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">${student.name}</td>
              <td class="px-6 py-2 text-nowrap">${student.school_name}</td>
              <td class="px-6 py-2 text-nowrap">${getStatusLabel(student.status)}</td>
              <td class="px-6 py-2 font-medium">${student.answer_count} / {{ $quiz->questions->count() }}</td>
            </tr>
          `;
          tableBody.innerHTML += row;
        });
      }
      updateTable()

      setInterval(function() {
        const currentTime = new Date().getTime();
        studentsData.forEach((student) => {
          if (student.id == 1) {
            if (lastEventTime[student.id] && (currentTime - lastEventTime[student.id] > 3000)) {
              student.status = 'offline';
              updateTable();
            }
          }
        });
      }, 1000);
    })
  </script>
  <div class="relative overflow-x-auto rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th class="px-6 py-3">No</th>
          <th class="px-6 py-3">Nama</th>
          <th class="px-6 py-3">Sekolah</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3">Jawaban</th>
        </tr>
      </thead>
      <tbody id="students-table-body">
      </tbody>
    </table>
  </div>
</div>
