 @props(['name', 'id'])

 <select name="{{ $name }}" id="{{ $id }}"
     class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
     {{ $slot }}
 </select>
