@extends('layouts/layoutAdmin')
@section('content')
<style>
.gantt-container {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.gantt-headers {
    display: flex;
    font-weight: bold;
    margin-bottom: 10px;
}

.task-header {
    width: 20%;
    padding: 10px;
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    margin-top: 10px;
}

.timeline-header {
    width: 80%;
    padding: 10px;
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    text-align: center;
    margin-top: 10px;
}

.gantt-chart {
    display: flex;
    flex-direction: column;
    border: 1px solid #ccc;
}

.gantt-row {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #eee;
}

.task-name {
    width: 20%;
    padding: 30px;
    border-right: 1px solid #ccc;
    background-color: #fafafa;
}

.gantt-bar-container {
    width: 80%;
    position: relative;
}

.gantt-bar {
    position: absolute;
    height: 30px;
    background-color: #2a9df4;
    border-radius: 5px;
    color: #fff;
    text-align: center;
    line-height: 30px;
}

.time-container {
    position: absolute;
    left: 0;
    top: -40px; /* Đẩy thông tin lên trên cột thời gian */
    width: 100%;
    padding: 5px;
    background-color: rgba(0, 0, 0, 0.2);
    color: #fff;
    border-radius: 5px;
    text-align: center;
}

.time-details {
    margin-top: 5px;
    font-size: 10px;
}
.month-row {
    display: flex;
    font-size: 12px;
    font-weight: bold;
    margin-top: 10px;
}

.month-cell {
    flex: 1;
    text-align: center;
    border: 1px solid #ccc;
    padding: 5px;
    box-sizing: border-box;
}

.month-header {
    width: 20%;
    text-align: center;
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    padding: 5px;
}



</style>

<div class="gantt-container">
        <div class="gantt-headers">
            <div class="task-header">Tên Công Việc</div>
            <div class="timeline-header">Thời Gian</div>
        </div>
        <div class="gantt-chart" id="ganttChart"></div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo các biến ngày dự án với giá trị mặc định
    let projectStartDate = new Date('1970-01-01'); // Giá trị mặc định trước khi nhận dữ liệu
    let projectEndDate = new Date('1970-01-01'); // Giá trị mặc định trước khi nhận dữ liệu
    let totalDuration = 0; // Giá trị mặc định trước khi tính toán

    // Hàm lấy ID từ đường dẫn hiện tại
    function getIdFromUrl() {
        const path = window.location.pathname; // Lấy đường dẫn hiện tại
        const segments = path.split('/'); // Tách đường dẫn theo dấu '/'
        const id = segments.pop(); // Lấy phần tử cuối cùng (ID)
        return id;
    }

    // Lấy ID từ đường dẫn
    const id = getIdFromUrl();
    // Tạo URL với ID
    const url = `/SoDoCongViec/data/${id}`; // Thay '1' bằng id thực tế bạn muốn lấy dữ liệu

    // Hàm định dạng ngày theo định dạng VN
    function formatDateVN(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    // Hàm định dạng tháng/năm
    function formatMonthYear(date) {
        const months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        const month = months[date.getMonth()];
        const year = date.getFullYear();
        return `${month}/${year}`;
    }

    // Hàm tạo hàng tháng
    function createMonthRow(startDate, endDate) {
        const monthRow = document.createElement('div');
        monthRow.className = 'month-row';

        // Tạo header tháng
        const monthHeader = document.createElement('div');
        monthHeader.className = 'month-header';
        monthHeader.textContent = 'Tháng';
        monthRow.appendChild(monthHeader);

        let currentDate = new Date(startDate.getFullYear(), startDate.getMonth(), 1); // Bắt đầu từ ngày đầu tháng của startDate
        const endMonth = endDate.getFullYear() * 12 + endDate.getMonth();

        while (currentDate.getFullYear() * 12 + currentDate.getMonth() <= endMonth) {
            const monthCell = document.createElement('div');
            monthCell.className = 'month-cell';
            monthCell.textContent = formatMonthYear(currentDate);

            monthRow.appendChild(monthCell);

            // Di chuyển đến tháng tiếp theo
            currentDate.setMonth(currentDate.getMonth() + 1);
        }

        ganttChart.appendChild(monthRow);
    }

    // Hàm tạo các giai đoạn
    function createStages(stages) {
        stages.forEach((stage) => {
            const stageStartDate = new Date(stage.NgayBatDau);
            const stageEndDate = new Date(stage.NgayKetThuc);
            const stageDuration = Math.round((stageEndDate - stageStartDate) / (1000 * 60 * 60 * 24)); // Số ngày của giai đoạn
            const daysFromProjectStart = Math.round((stageStartDate - projectStartDate) / (1000 * 60 * 60 * 24)); // Số ngày từ khi dự án bắt đầu

            const leftPercentage = (daysFromProjectStart / totalDuration) * 100;
            const widthPercentage = (stageDuration / totalDuration) * 100;

            const row = document.createElement('div');
            row.className = 'gantt-row';

            const taskName = document.createElement('div');
            taskName.className = 'task-name';
            taskName.textContent = stage.TenCongViec;

            const barContainer = document.createElement('div');
            barContainer.className = 'gantt-bar-container';

            const bar = document.createElement('div');
            bar.className = 'gantt-bar';
            bar.style.left = `${leftPercentage}%`;
            bar.style.width = `${widthPercentage}%`;

            // Tạo một div bao quanh thời gian
            const timeContainer = document.createElement('div');
            timeContainer.className = 'time-container';
            timeContainer.innerHTML = `
                <div class="time-details">
                    ${stageDuration} ngày
                </div>
            `;

            // Gắn timeContainer vào bar
            bar.appendChild(timeContainer);
            barContainer.appendChild(bar);
            row.appendChild(taskName);
            row.appendChild(barContainer);
            ganttChart.appendChild(row);
        });
    }

    // Gọi AJAX để lấy dữ liệu từ server
    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            // Giả sử response chứa dữ liệu giai đoạn
            const stages = response.data; // Điều chỉnh theo cấu trúc dữ liệu trả về từ server

            if (stages.length > 0) {
                const firstStageStartDate = new Date(stages[0].NgayBatDauDuAn);
                const lastStageEndDate = new Date(stages[0].NgayKetThucDuAn);

                // Cập nhật ngày bắt đầu và ngày kết thúc dự án
                projectStartDate = firstStageStartDate;
                projectEndDate = lastStageEndDate;
                totalDuration = Math.round((projectEndDate - projectStartDate) / (1000 * 60 * 60 * 24)); // Tổng số ngày của dự án

             
                // Thêm hàng tháng vào Gantt chart
                createMonthRow(projectStartDate, projectEndDate);

                // Thêm các giai đoạn vào Gantt chart
                createStages(stages);
            } else {
                console.error('Không có dữ liệu giai đoạn.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Có lỗi xảy ra khi lấy dữ liệu:', error);
        }
    });
});

</script>

@endsection


