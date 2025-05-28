<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Print Recap</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <style>
      @media print {
        .print-button {
          display: none;
        }
      }
    </style>
  </head>

  <body>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <!-- Print Quizz Recap -->
        <section id="header">
          <div class="container-fluid py-4">
            <div class="row">
              <div class="col-md-12">
                <form action="">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="container-fluid">
                        <div class="row border-bottom border-dark border-2 p-3">
                          <div class="col-2 text-end">
                            <img
                              src="{{ asset("/images/logo.webp") }}"
                              alt="logo"
                              height="70px"
                            />
                          </div>
                          <div class="col-8 text-center">
                            <h3>Результаты тестирования</h3>
                            <p>Результаты повторного подсчета баллов, сдавших экзамен CBT</p>
                          </div>
                          <div class="col-2"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-8 col-md-3">
                            <table class="table-borderless table">
                              <tbody>
                                <tr>
                                  <td>Название</td>
                                  <td>:</td>
                                  <td>{{ $quiz->name }}</td>
                                </tr>
                                <br />
                                <tr>
                                  <td>Тип</td>
                                  <td>:</td>
                                  <td>
                                    {{ $quiz->quiz_type->description }}
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 p-4">
                            <div class="table-responsive">
                              <table class="table-bordered table text-center">
                                <thead>
                                  <tr>
                                    <th class="">Рейтинг</th>
                                    <th class="col-md-4">Имя студента</th>
                                    <th class="col-md-4">NISN</th>
                                    <th class="col-md-4">Школа</th>
                                    <th class="col-md-4">Значение</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($quiz_students as $quizStudent)
                                    <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>
                                        {{ $quizStudent->student->name }}
                                      </td>
                                      <td>
                                        {{ $quizStudent->student->username }}
                                      </td>
                                      <td>
                                        {{ $quizStudent->student->school->name }}
                                      </td>
                                      <td>{{ $quizStudent->score }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <a
                        href="{{ route("filament.admin.resources.quiz-recaps.view", ["record" => $quiz->id]) }}"
                      >
                        <button
                          type="button"
                          class="btn btn-primary fs-6 print-button"
                        >
                          <i class="bi bi-arrow-left"></i>
                          Назад
                        </button>
                      </a>
                      <button
                        type="button"
                        class="btn btn-primary fs-6 print-button"
                        onclick="window.print()"
                      >
                        <i class="bi bi-printer"></i>
                        Печать
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
