<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.6/tailwind.min.css" />
  <style>
    b {
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body class="bg-white">
  <section class="w-full py-4">
    <header class="w-full py-4 text-center">
      <h4 style="font-size: 32px;" class="text-center font-bold pb-2 my-0">
        {{ $title }}<br />
      </h4>
      <p class="font-light">
        email do contratante: {{ $contract->email }} | email do proprietário: {{ $contract->immobile->email }}
      </p>
      <hr>
    </header>
    <section class="w-full mx-auto">
      <h5 class="font-normal">
      O contratante, {{trim($contract->name)}}, na condição de pessoa {{ ($contract->personType === 1) ? 'Juridíca': 'Civíl' }}, registrado(a) no {{ ($contract->personType === 1) ? 'CNPJ': 'CPF' }}: {{ $contract->document }}, está exercendo a alocação do imóvel, cod. {{ $contract->immobile_id }},
      situado na localidade da {{ $contract->immobile->address }} - n° {{ $contract->immobile->number }}, {{ $contract->immobile->neighborhood }}, {{ $contract->immobile->city }}, {{ $contract->immobile->state }}{{ ($contract->immobile->complement) ? ' , '.$contract->immobile->complement:'' }}, tendo efetuado a solicitação por meio da locadora WWF.
      </h5>
      <hr class="w-6/12 mx-auto my-8" />
      <div class="w-8/12 mx-auto">
        <p class="text:p">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum consequuntur soluta earum recusandae est ullam maxime ab optio aliquid, repudiandae corrupti asperiores architecto qui iure! Voluptates facilis nulla ea animi!
          Facere mollitia ipsum impedit optio. Quisquam suscipit amet rem, hic id provident facere, labore, ipsam porro sint dignissimos doloribus debitis repellat. Libero reiciendis quas asperiores voluptatem! Itaque sint culpa sed.
          Harum magni est nostrum quae tempora quo voluptas dolor at, quisquam quos voluptatibus ducimus reiciendis labore earum! Velit labore suscipit possimus culpa, itaque fuga quaerat quam tenetur voluptatibus aspernatur recusandae?
          Eius tenetur veritatis sint tempora ex, dolor magni, est porro, aperiam eum laborum molestiae voluptatibus perspiciatis a sit laudantium perferendis! Voluptatem suscipit distinctio quibusdam accusamus laborum nisi porro molestias ratione.
          Deserunt, minima? Fugit, placeat deserunt nam eos in magni aliquid minima, harum soluta sapiente quod expedita officia accusamus totam non laboriosam ad eum. Delectus dolor laudantium nobis expedita perferendis quas.
          Tempora molestiae adipisci, perspiciatis assumenda sint cupiditate. Impedit quas ad tempore illo iusto suscipit magnam enim velit temporibus, error unde cupiditate sit voluptas esse rem, exercitationem tenetur excepturi. Quis, adipisci.
          Atque earum minus laboriosam, voluptate veritatis sed in quam amet porro unde praesentium tenetur ullam quod reprehenderit quas cum. Commodi odit deserunt ipsum velit voluptates delectus tempore perspiciatis similique reiciendis?
          Minus, eveniet repellendus accusamus beatae ea deleniti. Quam rem nisi culpa laboriosam quibusdam cumque! Cum sapiente necessitatibus illum, omnis ea distinctio ab repudiandae enim corrupti quia atque. Perferendis, ratione ipsum.
          Tempora repudiandae libero molestiae ducimus dolores beatae cupiditate aliquam aliquid voluptatibus corporis deleniti quasi quo adipisci nihil necessitatibus atque reprehenderit, voluptates explicabo? Minima ea consectetur natus nemo aspernatur dolorum velit.
          Mollitia voluptate corporis inventore id. Itaque iste, sint minus voluptatem similique eaque, natus perferendis aperiam molestiae culpa cum mollitia vero illo! Consequuntur nihil tempora autem, qui velit magni non quae.
          Impedit ut error necessitatibus earum fugit aliquam magnam debitis beatae laudantium, aliquid est, cum molestiae totam sapiente minus, tempora incidunt ad quibusdam explicabo voluptatum id? Eaque officia repudiandae magnam porro!
          Similique nam laboriosam architecto in consectetur corporis aliquam nemo quo perspiciatis beatae nihil voluptatem temporibus distinctio ex dolorem, magni facilis inventore voluptatum aspernatur, id animi minus! Laboriosam beatae exercitationem tenetur.
        </p>
      </div>
    </section>
  </section>
</body>
</html>