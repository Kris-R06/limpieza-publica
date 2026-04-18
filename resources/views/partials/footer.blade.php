</main>
  {{-- /main --}}

  {{-- ══════════ FOOTER ══════════ --}}
  <footer class="border-t border-slate-800 bg-slate-900 mt-auto">
    <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500">
      <p class="font-heading tracking-wide uppercase">
        SISLIP — Sistema de Limpieza Pública Municipal
      </p>
      <p>© {{ date('Y') }} · Dirección de Servicios Públicos</p>
    </div>
  </footer>

</div>{{-- /wrapper principal --}}

{{-- JS compartido: sidebar toggle + fecha en header --}}
<script src="{{ asset('js/sidebar.js') }}"></script>

</body>
</html>