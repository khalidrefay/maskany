@extends('layouts.app')

@section('title', 'قائمة تقديرات المشاريع')

@section('css')
    <style>
        .project-table-container {
            max-width: 1100px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .scrollable-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .project-table {
            width: 100%;
            min-width: 1200px;
            border-collapse: collapse;
        }

        .project-table th,
        .project-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e9ecef;
            text-align: right;
            white-space: nowrap;
        }

        .project-table th {
            background: #f8f9fa;
            color: #2c5aa0;
            font-weight: 600;
        }

        .project-table tr:last-child td {
            border-bottom: none;
        }

        .action-btn {
            margin-left: 0.5rem;
            margin-bottom: 0.2rem;
            padding: 0.3rem 0.7rem;
            border: none;
            border-radius: 4px;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .view-btn {
            background: #2196F3;
            color: #fff;
        }

        .edit-btn {
            background: #FFC107;
            color: #333;
        }

        .delete-btn {
            background: #F44336;
            color: #fff;
        }

        .estimate-total {
            font-weight: bold;
            color: #4CAF50;
        }

        @media (max-width: 1200px) {
            .project-table-container {
                padding: 1rem;
            }

            .project-table {
                min-width: 900px;
            }
        }

        @media (max-width: 900px) {
            .project-table {
                min-width: 700px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="project-table-container">
        <h2 style="text-align:center; margin-bottom:1.5rem;">كل تقديرات المشاريع</h2>
        <div class="scrollable-table-wrapper">
            <table class="project-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المدينة</th>
                        <th>الحي</th>
                        <th>مساحة الأرض (م²)</th>
                        <th>النمط المعماري</th>
                        <th>مستوى التشطيب</th>
                        <th>شكل المبنى</th>
                        <th>عدد الطوابق</th>
                        <th>عدد الغرف</th>
                        <th>عدد الصالات</th>
                        <th>عدد الحمامات</th>
                        <th>عدد المطابخ</th>
                        <th>عدد الملاحق</th>
                        <th>مواقف السيارات</th>
                        <th>المساحة المطلوبة (م²)</th>
                        <th>الشروط</th>
                        <th>الاتصال لاحقاً</th>
                        <th>التكلفة التقديرية</th>
                        <th>تاريخ التقدير</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estimates as $estimate)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $estimate->city }}</td>
                            <td>{{ $estimate->district }}</td>
                            <td>{{ $estimate->land_area }}</td>
                            <td>{{ $estimate->design }}</td>
                            <td>{{ $estimate->finishing }}</td>
                            <td>{{ $estimate->shape }}</td>
                            <td>{{ $estimate->floors }}</td>
                            <td>{{ $estimate->bedrooms }}</td>
                            <td>{{ $estimate->living_rooms }}</td>
                            <td>{{ $estimate->bathrooms }}</td>
                            <td>{{ $estimate->kitchens }}</td>
                            <td>{{ $estimate->annexes }}</td>
                            <td>{{ $estimate->parking }}</td>
                            <td>{{ $estimate->required_area }}</td>
                            <td>
                                @if ($estimate->terms)
                                    <span style="color:green;">نعم</span>
                                @else
                                    <span style="color:red;">لا</span>
                                @endif
                            </td>
                            <td>
                                @if ($estimate->contact)
                                    <span style="color:green;">نعم</span>
                                @else
                                    <span style="color:red;">لا</span>
                                @endif
                            </td>
                            <td class="estimate-total">{{ number_format($estimate->estimate) }} ر.س</td>
                            <td>{{ $estimate->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('project.show', $estimate->id) }}" class="action-btn view-btn">عرض</a>
                                <a href="{{ route('project.edit', $estimate->id) }}" class="action-btn edit-btn">تعديل</a>
                                <form action="{{ route('project.destroy', $estimate->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn"
                                        onclick="return confirm('هل أنت متأكد من حذف هذا المشروع؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="20" style="text-align:center; color:#888;">لا توجد مشاريع.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:1.5rem;">
            {{ $estimates->links() }}
        </div>
    </div>
@endsection
