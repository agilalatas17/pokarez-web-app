 @props(['value', 'name', 'id'])

 <textarea id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
     class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-96">
     {{ $value }}
 </textarea>
